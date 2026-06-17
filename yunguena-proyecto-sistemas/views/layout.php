<?php
// views/layout.php — Shell HTML principal
if (session_status() === PHP_SESSION_NONE) session_start();
$isLogged = !empty($_SESSION['user_id']);
$userName = $_SESSION['user_nombre'] ?? '';
$page     = $_GET['page'] ?? 'home';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Flota Yungueña — Reserva de Boletos</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<!-- ── NAVBAR ── -->
<nav>
  <a href="index.php?page=home" class="nav-logo">Flota <span>Yungueña</span></a>

  <div class="nav-links">
    <a href="index.php?page=home"      class="<?= $page==='home'       ? 'active':'' ?>">Inicio</a>
    <a href="index.php?page=rutas"     class="<?= $page==='rutas'      ? 'active':'' ?>">Rutas</a>
    <?php if($isLogged): ?>
    <a href="index.php?page=mis_reservas" class="<?= $page==='mis_reservas' ? 'active':'' ?>">Mis Boletos</a>
    <?php endif; ?>
  </div>

  <div class="nav-right">
    <?php if ($isLogged): ?>
      <span class="nav-user">👤 <?= htmlspecialchars($userName) ?></span>
      <a href="index.php?page=logout" class="btn-nav outline btn-sm">Salir</a>
    <?php else: ?>
      <a href="index.php?page=login"    class="btn-nav outline btn-sm">Iniciar sesión</a>
      <a href="index.php?page=register" class="btn-nav primary btn-sm">Registrarse</a>
    <?php endif; ?>
  </div>
</nav>

<!-- ── CONTENIDO PRINCIPAL ── -->
<main>
<?php
// Cargar la vista según la página
switch($page){

    case 'home':
        $viewFile = 'views/home.php';
        break;

    case 'rutas':
        $viewFile = 'views/rutas.php';
        break;

    case 'detalle_viaje':
        $viewFile = 'views/detalle_viaje.php';
        break;

    case 'reserva':
        $viewFile = 'views/reserva.php';
        break;

    case 'mis_reservas':
        $viewFile = 'views/mis_reservas.php';
        break;

    case 'confirmacion':
        $viewFile = 'views/confirmacion.php';
        break;

    case 'login':
        $viewFile = 'views/login.php';
        break;

    case 'register':
        $viewFile = 'views/register.php';
        break;

    default:
        $viewFile = 'views/home.php';
        break;
}

if (file_exists($viewFile)) {
  require $viewFile;
} else {
  echo '<div class="empty-state"><h3>Página no encontrada</h3></div>';
}
?>
</main>

<!-- ── FOOTER ── -->
<footer>
  <div class="footer-brand">
    <div class="logo">El <span>Dorado</span></div>
    <p>La empresa de transporte interprovincial más confiable de Bolivia. Conectando ciudades desde 1998.</p>
  </div>
  <div>
    <h4>Rutas</h4>
    <a href="index.php?page=rutas">La Paz → Santa Cruz</a>
    <a href="index.php?page=rutas">La Paz → Cochabamba</a>
    <a href="index.php?page=rutas">Sucre → Potosí</a>
    <a href="index.php?page=rutas">Oruro → La Paz</a>
  </div>
  <div>
    <h4>Empresa</h4>
    <a href="#">Quiénes somos</a>
    <a href="#">Flota de buses</a>
    <a href="#">Trabaja con nosotros</a>
  </div>
  <div>
    <h4>Soporte</h4>
    <a href="#">Preguntas frecuentes</a>
    <a href="#">Cambio de boleto</a>
    <a href="#">Reembolsos</a>
    <a href="#">Contacto</a>
  </div>
</footer>
<div class="footer-bottom">
  <span>© <?= date('Y') ?> El Dorado Bus S.A. · Todos los derechos reservados</span>
  <span>Hecho con ♥ en Bolivia</span>
</div>

<script src="app/app.js"></script>
</body>
</html>