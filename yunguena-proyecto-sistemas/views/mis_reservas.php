<section class="mis-reservas">

    <h1>Mis Reservas</h1>

    <?php if(empty($reservas)): ?>

        <div class="empty-card">
            <h3>No tienes reservas registradas</h3>
        </div>

    <?php else: ?>

        <div class="tabla-reservas">

            <?php foreach($reservas as $r): ?>

            <div class="ticket-card">

                <div class="ticket-header">
                    <span><?= $r['codigo'] ?></span>
                    <span class="estado">
                        <?= $r['estado'] ?>
                    </span>
                </div>

                <h3>
                    <?= $r['origen'] ?>
                    →
                    <?= $r['destino'] ?>
                </h3>

                <div class="ticket-body">

                    <p><strong>Fecha:</strong> <?= $r['fecha_viaje'] ?></p>

                    <p><strong>Asiento:</strong> <?= $r['asiento'] ?></p>

                    <p><strong>Precio:</strong> Bs <?= $r['precio_final'] ?></p>

                </div>

            </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</section>