<?php
// views/register.php
if (session_status() === PHP_SESSION_NONE) session_start();
$error = $_SESSION['auth_error'] ?? '';
unset($_SESSION['auth_error']);
?>

<div class="auth-wrapper">
  <div class="auth-card">
    <img
      class="bus-image-strip"
      src="https://images.unsplash.com/photo-1570125909517-53cb21c89ff2?w=800&q=80&auto=format&fit=crop"
      alt="Flota El Dorado"
    />
    <div style="padding:2rem 2rem 0">

      <div class="auth-logo">
        <div class="logo-txt">El <span>Dorado</span></div>
        <p>Crea tu cuenta y viaja con nosotros</p>
      </div>

      <h2>Crear cuenta</h2>

      <?php if ($error): ?>
        <div class="auth-error">⚠ <?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form action="index.php?page=register" method="POST">
        <div class="form-row">
          <div class="form-group">
            <label>Nombre *</label>
            <input type="text" name="nombre" required placeholder="Carlos" />
          </div>
          <div class="form-group">
            <label>Apellido *</label>
            <input type="text" name="apellido" required placeholder="Mamani" />
          </div>
        </div>
        <div class="form-group">
          <label>Correo electrónico *</label>
          <input type="email" name="email" required placeholder="correo@ejemplo.com" />
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>CI / Cédula</label>
            <input type="text" name="ci" placeholder="7654321" />
          </div>
          <div class="form-group">
            <label>Teléfono</label>
            <input type="tel" name="telefono" placeholder="78901234" />
          </div>
        </div>
        <div class="form-group">
          <label>Contraseña * (mín. 6 caracteres)</label>
          <input type="password" name="password" required placeholder="••••••••" minlength="6" />
        </div>
        <button type="submit" class="btn btn-primary btn-block" style="margin-top:.5rem">
          Registrarme →
        </button>
      </form>

      <div class="auth-divider">¿Ya tienes cuenta?</div>
      <a href="index.php?page=login" class="btn btn-outline btn-block">Iniciar sesión</a>

      <div class="auth-footer">
        <a href="index.php?page=home">← Volver al inicio</a>
      </div>
    </div>
  </div>
</div>