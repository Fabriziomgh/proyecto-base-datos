const btn = document.getElementById('btn-salir');
const desplegar = document.getElementById('desplegar');
const campoFecha = document.getElementById('fecha');
const mesas = document.querySelectorAll('.mesas');
const mesasLabel = document.querySelectorAll('.mesas-label');
const ul = document.querySelector('.ul');

btn.addEventListener('click', () => {
   desplegar.classList.toggle('hidden');
});

const fechaActual = new Date().toISOString().split('T', 1).join();
campoFecha.setAttribute('min', fechaActual);

mesas.forEach((mesas) =>{
   
})
   

