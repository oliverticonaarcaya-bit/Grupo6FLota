<?php
// models/RutaModel.php

require_once __DIR__ . '/../config/database.php';

class RutaModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /** Todas las rutas activas con ciudad origen/destino */
    public function getAll(): array {
        $stmt = $this->db->query(
            "SELECT r.id, r.precio_base, r.duracion_h, r.distancia_km,
                    c_o.nombre AS origen, c_d.nombre AS destino
             FROM rutas r
             JOIN ciudades c_o ON c_o.id = r.origen_id
             JOIN ciudades c_d ON c_d.id = r.destino_id
             WHERE r.activo = 1
             ORDER BY c_o.nombre, c_d.nombre"
        );
        return $stmt->fetchAll();
    }

    /** Viajes disponibles (usa la vista v_viajes_disponibles) */
    public function getViajesDisponibles(string $origen = '', string $destino = '', string $fecha = ''): array {
        $where = ['v.estado = "programado"', 'v.fecha_viaje >= CURDATE()'];
        $params = [];

        if ($origen) {
            $where[]  = 'c_o.nombre LIKE ?';
            $params[] = "%$origen%";
        }
        if ($destino) {
            $where[]  = 'c_d.nombre LIKE ?';
            $params[] = "%$destino%";
        }
        if ($fecha) {
            $where[]  = 'v.fecha_viaje = ?';
            $params[] = $fecha;
        }

        $sql = "SELECT
                  v.id AS viaje_id, v.fecha_viaje, v.precio, v.estado,
                  c_o.nombre AS origen, c_d.nombre AS destino,
                  h.hora_salida, h.hora_llegada, r.duracion_h,
                  b.tipo AS tipo_bus, b.total_seats, b.placa,
                  (SELECT COUNT(*) FROM reservas res
                   WHERE res.viaje_id = v.id AND res.estado != 'cancelada') AS asientos_ocupados
                FROM viajes v
                JOIN horarios h   ON h.id  = v.horario_id
                JOIN rutas    r   ON r.id  = h.ruta_id
                JOIN ciudades c_o ON c_o.id = r.origen_id
                JOIN ciudades c_d ON c_d.id = r.destino_id
                JOIN buses    b   ON b.id  = h.bus_id
                WHERE " . implode(' AND ', $where) . "
                ORDER BY v.fecha_viaje, h.hora_salida";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /** Detalle de un viaje */
    public function getViajeById(int $id): ?array {
        $stmt = $this->db->prepare(
            "SELECT v.*, h.hora_salida, h.hora_llegada, h.bus_id,
                    r.duracion_h, r.precio_base,
                    c_o.nombre AS origen, c_d.nombre AS destino,
                    b.tipo AS tipo_bus, b.total_seats, b.placa
             FROM viajes v
             JOIN horarios h   ON h.id  = v.horario_id
             JOIN rutas    r   ON r.id  = h.ruta_id
             JOIN ciudades c_o ON c_o.id = r.origen_id
             JOIN ciudades c_d ON c_d.id = r.destino_id
             JOIN buses    b   ON b.id  = h.bus_id
             WHERE v.id = ? LIMIT 1"
        );
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** Asientos ocupados de un viaje */
    public function getAsientosOcupados(int $viajeId): array {
        $stmt = $this->db->prepare(
            "SELECT a.numero FROM reservas res
             JOIN asientos a ON a.id = res.asiento_id
             WHERE res.viaje_id = ? AND res.estado != 'cancelada'"
        );
        $stmt->execute([$viajeId]);
        return array_column($stmt->fetchAll(), 'numero');
    }

    /** Asientos del bus de un viaje */
    public function getAsientosBus(int $busId): array {
        $stmt = $this->db->prepare(
            "SELECT id, numero, tipo FROM asientos WHERE bus_id = ? ORDER BY numero"
        );
        $stmt->execute([$busId]);
        return $stmt->fetchAll();
    }

    /** Todas las ciudades */
    public function getCiudades(): array {
        return $this->db->query('SELECT * FROM ciudades ORDER BY nombre')->fetchAll();
    }
}