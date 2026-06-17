<?php // views/home.php ?>

<!-- ── HERO ── -->
<section class="hero">
  <div class="hero-left">
    <div class="hero-badge">&#11044; Servicio desde 1998 · 26 años</div>
    <h1>Viaja por <em>Bolivia</em> con confianza</h1>
    <p>La flota más moderna del país. Rutas desde La Paz hasta Santa Cruz, Beni, Pando y más. Reserva tu asiento en minutos.</p>
    <div class="hero-actions">
      <a href="index.php?page=rutas" class="btn btn-primary">Ver todas las rutas</a>
      <?php if (!empty($_SESSION['user_id'])): ?>
        <a href="index.php?page=mis_reservas" class="btn btn-outline">Mis Boletos</a>
      <?php else: ?>
        <a href="index.php?page=login" class="btn btn-outline">Iniciar sesión</a>
      <?php endif; ?>
    </div>
    <div class="hero-stats">
      <div><div class="stat-num">48+</div><div class="stat-label">Rutas nacionales</div></div>
      <div><div class="stat-num">120k</div><div class="stat-label">Pasajeros al año</div></div>
      <div><div class="stat-num">99%</div><div class="stat-label">Puntualidad</div></div>
    </div>
  </div>
  <div class="hero-right">
    <!-- Imagen real de bus El Dorado desde Unsplash (bus boliviano/latinoamericano) -->
    <img
      class="hero-bus-img"
      src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=900&q=80&auto=format&fit=crop"
      alt="Bus Flota Yungueña en carretera boliviana"
    />
  </div>
</section>

<!-- ── SEARCH ── -->
<section class="search-section">
  <div class="search-card">
    <div class="search-title">Buscar mi viaje</div>
    <form action="index.php" method="GET" class="search-grid">
      <input type="hidden" name="page" value="rutas" />
      <input type="hidden" name="buscar" value="1" />
      <div class="field">
        <label>Origen</label>
        <input type="text" name="origen" placeholder="Ej: La Paz" />
      </div>
      <div class="field">
        <label>Destino</label>
        <input type="text" name="destino" placeholder="Ej: Santa Cruz" />
      </div>
      <div class="field">
        <label>Fecha de viaje</label>
        <input type="date" name="fecha" />
      </div>
      <button type="submit" class="btn btn-primary">Buscar →</button>
    </form>
  </div>
</section>

<!-- ── BUS GALLERY ── -->
<section class="bus-gallery">
  <h2>Nuestra <em>flota</em></h2>
  <div class="gallery-grid">
    <div class="gallery-card">
      <img src="https://images.unsplash.com/photo-1570125909517-53cb21c89ff2?w=600&q=80&auto=format&fit=crop" alt="Bus Ejecutivo El Dorado" />
      <div class="gallery-card-body">
        <h4>Ejecutivo</h4>
        <p>40 asientos reclinables, WiFi, aire acondicionado y TV a bordo.</p>
      </div>
    </div>
    <div class="gallery-card">
      <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80&auto=format&fit=crop" alt="Bus Premium Cama El Dorado" />
      <div class="gallery-card-body">
        <h4>Premium Cama</h4>
        <p>Asientos 180° reclinables, snack incluido y servicio a bordo.</p>
      </div>
    </div>
    <div class="gallery-card">
      <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&q=80&auto=format&fit=crop" alt="Ruta montaña Bolivia" />
      <div class="gallery-card-body">
        <h4>Rutas escénicas</h4>
        <p>Recorre Bolivia por los paisajes más impresionantes de Sudamérica.</p>
      </div>
    </div>
  </div>
</section>