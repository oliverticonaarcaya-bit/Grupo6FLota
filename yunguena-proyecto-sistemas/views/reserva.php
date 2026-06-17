<section class="reserva-container">

    <div class="reserva-card">

        <h1>Confirmar Reserva</h1>

        <div class="resumen">

            <div>
                <strong>Ruta</strong>
                <p><?= $viaje['origen'] ?> → <?= $viaje['destino'] ?></p>
            </div>

            <div>
                <strong>Asiento</strong>
                <p><?= $asiento['numero'] ?></p>
            </div>

            <div>
                <strong>Precio</strong>
                <p>Bs <?= number_format($viaje['precio'],2) ?></p>
            </div>

        </div>

        <form method="POST" action="index.php?page=confirmar_reserva">

            <input type="hidden" name="viaje_id" value="<?= $viaje['id'] ?>">
            <input type="hidden" name="asiento_id" value="<?= $asiento['id'] ?>">
            <input type="hidden" name="precio" value="<?= $viaje['precio'] ?>">

            <input type="text" name="nombre" placeholder="Nombre" required>

            <input type="text" name="apellido" placeholder="Apellido" required>

            <input type="text" name="ci" placeholder="Carnet de Identidad" required>

            <select name="metodo_pago">
                <option value="tarjeta">Tarjeta</option>
                <option value="qr">QR</option>
            </select>

            <button class="btn-reservar">
                Confirmar Reserva
            </button>

        </form>

    </div>

</section>