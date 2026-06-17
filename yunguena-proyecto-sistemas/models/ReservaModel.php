<?php
// models/ReservaModel.php

require_once __DIR__ . '/../config/database.php';

class ReservaModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /** Crear reserva + pago (transacción) */
    public function create(array $data): string {
        $codigo = 'BB-' . strtoupper(substr(uniqid(), -6));

        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO reservas
                 (codigo, usuario_id, viaje_id, asiento_id,
                  nombre_pasajero, apellido_pasajero, ci_pasajero,
                  precio_final, estado, metodo_pago)
                 VALUES (?,?,?,?,?,?,?,?,?,?)"
            );
            $stmt->execute([
                $codigo,
                $data['usuario_id'],
                $data['viaje_id'],
                $data['asiento_id'],
                $data['nombre'],
                $data['apellido'],
                $data['ci'],
                $data['precio'],
                'confirmada',
                $data['metodo_pago'] ?? 'tarjeta',
            ]);
            $reservaId = $this->db->lastInsertId();

            $this->db->prepare(
                "INSERT INTO pagos (reserva_id, monto, estado, referencia)
                 VALUES (?,?,?,?)"
            )->execute([
                $reservaId,
                $data['precio'],
                'aprobado',
                'TXN-' . strtoupper(substr(md5(uniqid()), 0, 8)),
            ]);

            $this->db->commit();
            return $codigo;
        } catch (\Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    /** Reservas del usuario (usa v_mis_reservas) */
    public function getByUsuario(int $usuarioId): array {
        $stmt = $this->db->prepare(
            "SELECT mr.* FROM v_mis_reservas mr
             JOIN usuarios u ON u.email = mr.email
             WHERE u.id = ?
             ORDER BY mr.created_at DESC"
        );
        $stmt->execute([$usuarioId]);
        return $stmt->fetchAll();
    }

    /** Asiento ya reservado en ese viaje */
    public function asientoOcupado(int $viajeId, int $asientoId): bool {
        $stmt = $this->db->prepare(
            "SELECT id FROM reservas
             WHERE viaje_id = ? AND asiento_id = ? AND estado != 'cancelada'
             LIMIT 1"
        );
        $stmt->execute([$viajeId, $asientoId]);
        return (bool) $stmt->fetch();
    }

    /** Cancelar reserva */
    public function cancelar(string $codigo, int $usuarioId): bool {
        $stmt = $this->db->prepare(
            "UPDATE reservas SET estado = 'cancelada'
             WHERE codigo = ? AND usuario_id = ? AND estado = 'confirmada'"
        );
        $stmt->execute([$codigo, $usuarioId]);
        return $stmt->rowCount() > 0;
    }
}