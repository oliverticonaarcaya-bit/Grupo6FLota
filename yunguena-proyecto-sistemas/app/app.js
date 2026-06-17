// assets/js/app.js — El Dorado Bus

/* ─── Seat selector ─────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
  // Seat selection
  const seats = document.querySelectorAll('.seat:not(.occupied)');
  const hiddenSeatId = document.getElementById('asiento_id');
  const hiddenSeatNum = document.getElementById('asiento_num');
  const summSeat = document.getElementById('sum-seat');
  const summPrice = document.getElementById('sum-total');
  const basePrice = parseFloat(document.getElementById('base-price')?.dataset.price ?? 0);

  seats.forEach(seat => {
    seat.addEventListener('click', () => {
      seats.forEach(s => s.classList.remove('selected'));
      seat.classList.add('selected');

      const seatId  = seat.dataset.id;
      const seatNum = seat.dataset.num;
      const isPrem  = seat.dataset.tipo === 'premium';
      const price   = isPrem ? basePrice + 30 : basePrice;

      if (hiddenSeatId)  hiddenSeatId.value  = seatId;
      if (hiddenSeatNum) hiddenSeatNum.value  = seatNum;
      if (summSeat)      summSeat.textContent  = seatNum + (isPrem ? ' ⭐' : '');
      if (summPrice)     summPrice.textContent = 'Bs ' + price.toFixed(2);

      // Update hidden price field
      const priceField = document.getElementById('precio_final');
      if (priceField) priceField.value = price.toFixed(2);
    });
  });

  // Format credit card input
  const cardInput = document.getElementById('card-number');
  if (cardInput) {
    cardInput.addEventListener('input', () => {
      let v = cardInput.value.replace(/\D/g,'').substring(0,16);
      cardInput.value = v.replace(/(.{4})/g,'$1 ').trim();
    });
  }

  // Validate booking form before submit
  const bookingForm = document.getElementById('booking-form');
  if (bookingForm) {
    bookingForm.addEventListener('submit', e => {
      const seatId = document.getElementById('asiento_id')?.value;
      if (!seatId) {
        e.preventDefault();
        alert('Por favor selecciona un asiento antes de continuar.');
      }
    });
  }

  // Auto-hide alerts after 5s
  document.querySelectorAll('.alert').forEach(el => {
    setTimeout(() => el.style.opacity = '0', 4000);
  });

  // Set today's date as default on date inputs
  const dateInputs = document.querySelectorAll('input[type="date"]');
  const today = new Date().toISOString().split('T')[0];
  dateInputs.forEach(d => { if (!d.value) d.value = today; });
});