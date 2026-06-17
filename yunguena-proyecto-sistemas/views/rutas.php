<?php // views/rutas.php
$filtros = $filtros ?? [];
?>

<div class="page-header">
  <h2>Rutas <em>disponibles</em></h2>
  <p>Selecciona tu destino y reserva al instante</p>
</div>

<!-- Filtros -->
<section style="background:var(--dark);padding:0 4rem 2rem;">
  <form action="index.php" method="GET" class="search-grid" style="background:var(--white);padding:1.5rem 2rem;border-radius:var(--r-lg);">
    <input type="hidden" name="page" value="rutas" />
    <input type="hidden" name="buscar" value="1" />
    <div class="field">
      <label>Origen</label>
      <input type="text" name="origen" value="<?= htmlspecialchars($filtros['origen'] ?? '') ?>" placeholder="Ej: La Paz" />
    </div>
    <div class="field">
      <label>Destino</label>
      <input type="text" name="destino" value="<?= htmlspecialchars($filtros['destino'] ?? '') ?>" placeholder="Ej: Santa Cruz" />
    </div>
    <div class="field">
      <label>Fecha</label>
      <input type="date" name="fecha" value="<?= htmlspecialchars($filtros['fecha'] ?? '') ?>" />
    </div>
    <button type="submit" class="btn btn-primary">Buscar →</button>
  </form>
</section>

<!-- Resultados -->
<div class="routes-grid">
  <?php if (empty($viajes)): ?>
    <div class="empty-state" style="grid-column:1/-1">
      <h3>No se encontraron viajes</h3>
      <p>Prueba con otras ciudades o fecha</p>
    </div>
  <?php else: ?>
    <?php foreach ($viajes as $v):
      $libres = $v['total_seats'] - $v['asientos_ocupados'];
      $tipos  = ['economico'=>'Económico','ejecutivo'=>'Ejecutivo','premium_cama'=>'Premium Cama'];
      $tipo   = $tipos[$v['tipo_bus']] ?? $v['tipo_bus'];
      $tags   = ['economico'=>'Económico','ejecutivo'=>'Ejecutivo','premium_cama'=>'✦ Premium'];
      $tag    = $tags[$v['tipo_bus']] ?? 'Disponible';
    ?>
    <div class="route-card">
      <div class="route-card-top" data-bg="<?= substr($v['origen'],0,1).substr($v['destino'],0,1) ?>">
        <div class="route-tag"><?= $tag ?></div>
        <div class="route-cities">
          <span class="city-name"><?= htmlspecialchars($v['origen']) ?></span>
          <span class="route-arrow">→</span>
          <span class="city-name"><?= htmlspecialchars($v['destino']) ?></span>
        </div>
        <div style="font-size:.75rem;color:rgba(255,255,255,.45);margin-top:8px;">
          <?= date('d M Y', strtotime($v['fecha_viaje'])) ?> · Placa: <?= htmlspecialchars($v['placa']) ?>
        </div>
      </div>
      <div class="route-card-body">
        <div class="route-meta">
          <div class="meta-item">
            <div class="meta-val"><?= substr($v['hora_salida'],0,5) ?></div>
            <div class="meta-key">Salida</div>
          </div>
          <div class="meta-item">
            <div class="meta-val"><?= number_format($v['duracion_h'],1) ?>h</div>
            <div class="meta-key">Duración</div>
          </div>
          <div class="meta-item">
            <div class="meta-val"><?= substr($v['hora_llegada'],0,5) ?></div>
            <div class="meta-key">Llegada</div>
          </div>
        </div>
        <div class="route-card-footer">
          <div>
            <div class="route-price-tag">
              Bs <?= number_format($v['precio'],2) ?> <small>/ persona</small>
            </div>
            <div style="font-size:.75rem;color:var(--mid);margin-top:2px;"><?= $libres ?> asientos libres</div>
          </div>
          <a href="index.php?page=detalle_viaje&viaje_id=<?= $v['viaje_id'] ?>" class="btn btn-primary btn-sm">
            Reservar
          </a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>