<section class="detalle-container">

    <div class="detalle-card">

        <div class="detalle-header">
            <h1><?= $viaje['origen'] ?> → <?= $viaje['destino'] ?></h1>
            <span class="precio">
                Bs <?= number_format($viaje['precio'],2) ?>
            </span>
        </div>

        <div class="detalle-info">

            <div>
                <h4>Fecha</h4>
                <p><?= $viaje['fecha_viaje'] ?></p>
            </div>

            <div>
                <h4>Salida</h4>
                <p><?= $viaje['hora_salida'] ?></p>
            </div>

            <div>
                <h4>Llegada</h4>
                <p><?= $viaje['hora_llegada'] ?></p>
            </div>

            <div>
                <h4>Bus</h4>
                <p><?= $viaje['tipo_bus'] ?></p>
            </div>

        </div>

    </div>

    <h2 class="titulo-asientos">
        Selecciona tu asiento
    </h2>

    <div class="bus-layout">

        <?php foreach($asientos as $a): ?>

            <?php $ocupado = in_array($a['numero'],$asientosOcupados); ?>

            <?php if($ocupado): ?>

                <div class="asiento ocupado">
                    <?= $a['numero'] ?>
                </div>

            <?php else: ?>

                <a
                href="index.php?page=reserva&viaje_id=<?= $viaje['id'] ?>&asiento_id=<?= $a['id'] ?>"
                class="asiento libre">
                    <?= $a['numero'] ?>
                </a>

            <?php endif; ?>

        <?php endforeach; ?>

    </div>

</section>