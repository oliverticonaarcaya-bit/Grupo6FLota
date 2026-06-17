<?php
// controllers/ReservaController.php

require_once __DIR__ . '/../models/ReservaModel.php';
require_once __DIR__ . '/../models/RutaModel.php';

class ReservaController {
    private ReservaModel $reservaModel;
    private RutaModel    $rutaModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->reservaModel = new ReservaModel();
        $this->rutaModel    = new RutaModel();
    }

    /** Solo usuarios autenticados */
    private function requireLogin(): void {
        if (empty($_SESSION['user_id'])) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            header('Location: index.php?page=login');
            exit;
        }
    }

    /** GET index.php?page=reserva&viaje_id=X&asiento_id=Y */
    public function form(): array {
        $this->requireLogin();
        $viajeId   = (int)($_GET['viaje_id']   ?? 0);
        $asientoId = (int)($_GET['asiento_id'] ?? 0);

        $viaje = $this->rutaModel->getViajeById($viajeId);
        if (!$viaje) { header('Location: index.php?page=rutas'); exit; }

        // Datos del asiento
        $stmt = \Database::connect()->prepare(
            'SELECT id, numero, tipo FROM asientos WHERE id = ? LIMIT 1'
        );
        $stmt->execute([$asientoId]);
        $asiento = $stmt->fetch();

        return compact('viaje', 'asiento');
    }

    /** POST index.php?page=confirmar_reserva */
    public function confirmar(): void {
        $this->requireLogin();

        $viajeId   = (int)($_POST['viaje_id']   ?? 0);
        $asientoId = (int)($_POST['asiento_id'] ?? 0);
        $precio    = (float)($_POST['precio']   ?? 0);

        // Verificar que el asiento no se ocupó entre tanto
        if ($this->reservaModel->asientoOcupado($viajeId, $asientoId)) {
            $_SESSION['reserva_error'] = 'Ese asiento ya fue reservado. Elige otro.';
            header("Location: index.php?page=detalle_viaje&viaje_id=$viajeId");
            exit;
        }

        try {
            $codigo = $this->reservaModel->create([
                'usuario_id'  => $_SESSION['user_id'],
                'viaje_id'    => $viajeId,
                'asiento_id'  => $asientoId,
                'nombre'      => trim($_POST['nombre']      ?? ''),
                'apellido'    => trim($_POST['apellido']    ?? ''),
                'ci'          => trim($_POST['ci']          ?? ''),
                'precio'      => $precio,
                'metodo_pago' => $_POST['metodo_pago'] ?? 'tarjeta',
            ]);
            $_SESSION['ultimo_codigo'] = $codigo;
            header('Location: index.php?page=confirmacion');
            exit;
        } catch (\Exception $e) {
            $_SESSION['reserva_error'] = 'Error al confirmar la reserva. Intenta de nuevo.';
            header("Location: index.php?page=detalle_viaje&viaje_id=$viajeId");
            exit;
        }
    }

    /** GET index.php?page=mis_reservas */
    public function misReservas(): array {
        $this->requireLogin();
        return [
            'reservas' => $this->reservaModel->getByUsuario($_SESSION['user_id']),
        ];
    }

    /** POST index.php?page=cancelar_reserva */
    public function cancelar(): void {
        $this->requireLogin();
        $codigo = trim($_POST['codigo'] ?? '');
        $this->reservaModel->cancelar($codigo, $_SESSION['user_id']);
        header('Location: index.php?page=mis_reservas&msg=cancelada');
        exit;
    }
} 