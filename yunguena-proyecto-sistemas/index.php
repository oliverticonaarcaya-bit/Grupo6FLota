<?php
// index.php — Front Controller (punto de entrada único)

session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/RutaController.php';
require_once __DIR__ . '/controllers/ReservaController.php';

$page   = $_GET['page']   ?? 'home';
$action = $_GET['action'] ?? '';

// ─── Enrutamiento POST ───────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    match ($page) {
        'login'            => (new AuthController())->login(),
        'register'         => (new AuthController())->register(),
        'confirmar_reserva'=> (new ReservaController())->confirmar(),
        'cancelar_reserva' => (new ReservaController())->cancelar(),
        default            => header('Location: index.php')
    };
    exit;
}
    
// ─── Enrutamiento GET — recoger datos del controlador ────
$data = [];

switch ($page) {
    case 'logout':
        (new AuthController())->logout();
        break;

    case 'rutas':
        $ctrl = new RutaController();
        $data = isset($_GET['buscar']) ? $ctrl->buscar() : $ctrl->index();
        break;

    case 'detalle_viaje':
        $data = (new RutaController())->detalleViaje((int)($_GET['viaje_id'] ?? 0));
        break;

    case 'reserva':
        $data = (new ReservaController())->form();
        break;

    case 'mis_reservas':
        $data = (new ReservaController())->misReservas();
        break;

    case 'login':
    case 'register':
    case 'home':
    case 'confirmacion':
    default:
        break;
}

// ─── Render de la vista ──────────────────────────────────
extract($data);                         // variables disponibles en la vista
require __DIR__ . '/views/layout.php';  // layout principal