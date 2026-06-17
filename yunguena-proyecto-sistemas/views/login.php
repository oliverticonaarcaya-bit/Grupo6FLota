<?php
// views/login.php
if (session_status() === PHP_SESSION_NONE) session_start();
$error = $_SESSION['auth_error'] ?? '';
unset($_SESSION['auth_error']);
?>

<div class="auth-wrapper">
  <div class="auth-card">
    <!-- Imagen de bus arriba del card -->
    <img
      class="bus-image-strip"
      src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=800&q=80&auto=format&fit=crop&crop=center"
      alt="El Dorado Bus"
    />
    <div style="padding:2rem 2rem 0">

      <div class="auth-logo">
        <div class="logo-txt">El <span>Dorado</span></div>
        <p>Bienvenido de nuevo</p>
      </div>

      <h2>Iniciar sesión</h2>

      <?php if ($error): ?>
        <div class="auth-error">⚠ <?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form action="index.php?page=login" method="POST">
        <div class="form-group">
          <label>Correo electrónico</label>
          <input type="email" name="email" required placeholder="correo@ejemplo.com" autocomplete="email" />
        </div>
        <div class="form-group">
          <label>Contraseña</label>
          <input type="password" name="password" required placeholder="••••••••" autocomplete="current-password" />
        </div>
        <button type="submit" class="btn btn-primary btn-block" style="margin-top:.5rem">
          Ingresar →
        </button>
      </form>

      <div class="auth-divider">¿No tienes cuenta?</div>
      <a href="index.php?page=register" class="btn btn-outline btn-block">Crear cuenta gratis</a>

      <div class="auth-footer">
        <a href="index.php?page=home">← Volver al inicio</a>
      </div>
    </div>
  </div>
</div>