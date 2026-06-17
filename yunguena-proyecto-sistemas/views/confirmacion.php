<section class="confirmacion-container">

    <div class="confirmacion-card">

        <div class="check">
            ✓
        </div>

        <h1>Reserva Confirmada</h1>

        <p>
            Tu boleto fue registrado correctamente.
        </p>

        <div class="codigo">

            <?= $_SESSION['ultimo_codigo'] ?? '' ?>

        </div>

        <a href="index.php?page=mis_reservas"
           class="btn-confirmacion">

            Ver Mis Reservas

        </a>

    </div>

</section>