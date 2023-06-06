const btn = document.getElementById('btn-salir');
const desplegar = document.getElementById('desplegar');
const campoFecha = document.getElementById('fecha');
const eliminarMesa = document.getElementById('eliminar_mesa');

btn.addEventListener('click', () => {
   desplegar.classList.toggle('hidden');
});

const fechaActual = new Date().toISOString().split('T', 1).join();
campoFecha.setAttribute('min', fechaActual);

eliminarMesa.addEventListener('click', () => {
   const confirmacion = confirm('Seguro que desea cancelar su reservacion?');
   if (confirmacion) {
      eliminarMesa.setAttribute(
         '<?php echo eliminar.php?id= . $reserva["id"]; ?>'
      );
   }
});
