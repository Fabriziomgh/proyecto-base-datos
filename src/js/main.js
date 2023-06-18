const btn = document.getElementById('btn-salir');
const desplegar = document.getElementById('desplegar');
const campoFecha = document.getElementById('fecha');
const eliminarMesa = document.querySelectorAll('#eliminar_mesa');
const formMesa = document.querySelector('#form-mesa');
const btnEliminarRegistro = document.querySelectorAll('.btn-eliminar-registro');

const eliminarHandler = function (item, text, archivo) {
   const confirmacion = confirm(`${text}`);
   const id = item?.dataset?.id;
   if (confirmacion) {
      item.setAttribute('href', `${archivo}?id=${id}`);
   }
};

btn?.addEventListener('click', () => {
   desplegar.classList.toggle('hidden');
});

const fechaActual = new Date().toISOString().split('T', 1).join();
campoFecha?.setAttribute('min', fechaActual);

eliminarMesa.forEach((mesa) => {
   mesa?.addEventListener('click', () => {
      eliminarHandler(
         mesa,
         'Seguro que quiere cancelar su reservación?',
         'eliminar.php'
      );
   });
});
console.log(btnEliminarRegistro);

btnEliminarRegistro.forEach((registro) => {
   registro?.addEventListener('click', () => {
      eliminarHandler(
         registro,
         'Esta seguro de eliminar este registro?',
         'eliminarRegistro.php'
      );
   });
});
