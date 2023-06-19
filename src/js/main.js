const btn = document.getElementById('btn-salir');
const desplegar = document.getElementById('desplegar');
const campoFecha = document.getElementById('fecha');
const eliminarMesa = document.querySelectorAll('#eliminar_mesa');
const formMesa = document.querySelector('#form-mesa');
const btnEliminarRegistro = document.querySelectorAll('.btn-eliminar-registro');
const modal = document.getElementById('staticModal');
const btnOpenModal = document.getElementById('btn-open-modal');
const btnCloseModal = document.getElementById('btn-close-modal');
const modalEliminarMenu = document.getElementById('modal-eliminar-menu');
const btnOpenModalMenu = document.getElementById('btn-open-modal-eliminar');
const btnCloseModalMenu = document.getElementById('btn-close-modal-eliminar');

btnOpenModalMenu?.addEventListener('click', () => {
   modalEliminarMenu.classList.remove('hidden');
});
btnCloseModalMenu?.addEventListener('click', () => {
   modalEliminarMenu.classList.add('hidden');
});

btnOpenModal?.addEventListener('click', () => {
   modal.classList.remove('hidden');
});
btnCloseModal?.addEventListener('click', () => {
   modal.classList.add('hidden');
});

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

btnEliminarRegistro.forEach((registro) => {
   registro?.addEventListener('click', () => {
      eliminarHandler(
         registro,
         'Esta seguro de eliminar este registro?',
         'eliminarRegistro.php'
      );
   });
});
