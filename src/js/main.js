const btn = document.getElementById('btn-salir');
const desplegar = document.getElementById('desplegar');
const campoFecha = document.getElementById('fecha');
const eliminarMesa = document.querySelectorAll('#eliminar_mesa');

btn.addEventListener('click', () => {
   desplegar.classList.toggle('hidden');
});

const fechaActual = new Date().toISOString().split('T', 1).join();
campoFecha.setAttribute('min', fechaActual);

eliminarMesa.forEach((mesa) => {
   mesa.addEventListener('click', (e) => {
      console.log(e);
      const confirmacion = confirm('Seguro que desea cancelar su reservacion?');
      const id = mesa.dataset.id;
      console.log(id);
      if (confirmacion) {
         mesa.href = `eliminar.php?id=${id}`;
      }
   });
});
