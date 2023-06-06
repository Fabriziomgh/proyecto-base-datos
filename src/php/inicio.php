<?php
require_once '../config/db_conexion.php';
require_once './session/session_start.php';

?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/output.css">
  <link rel="icon" href="../assets/svg/restaurant-svgrepo-com.svg">
  <title>Restaurante - </title>
</head>

<body style=" background-image: linear-gradient(
            to right bottom,
            rgba(255, 255, 255, 0.7),
            rgba(255, 255, 255, 0.9)
        ),
        url('../assets/img/fondo.jpg');
    background-size: cover;
    background-position: center; ">
  <header class="bg-white text-sm mb-6 font-medium text-center text-gray-500 border-b border-gray-200 ">
    <nav class="flex justify-around items-center">

      <span class="text-2xl">
        <div class="inline relative">
          <button id="btn-salir">
            <img src="../assets/svg/flecha-abajo.svg">
          </button>
          <div id="desplegar" class="hidden absolute w-20 h-7 text-lg bg-white text-start border border-gray-400 rounded ">
            <a class="pl-2" href="./session/session_destroy.php">Salir</a>
          </div>
        </div>
        Hola,
        <span class="text-purple-600 italic"><?php echo $_SESSION['nombre']; ?></span>
      </span>
      <ul class="flex justify-center flex-wrap -mb-px">
        <li class="mr-2">
          <a href="./menu.php" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-purple-600 ">
            Menú
          </a>
        </li>
        <li class="mr-2">
          <a href="./reservas.php" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-purple-600 ">
            Reservas
          </a>
        </li>

      </ul>
    </nav>
  </header>


  <div class="text-center  text-3xl font-medium text-purple-600">Bienvenido</div>

  <div class="relative max-w-screen-xl p-4 px-4 mx-auto   sm:px-6 lg:px-8 py-26 lg:mt-20">
    <div class="relative">
      <div class="lg:grid lg:grid-flow-row-dense lg:grid-cols-2 lg:gap-8 lg:items-center">
        <div class="ml-auto lg:col-start-2 lg:max-w-2xl">
          <p class="text-base font-semibold leading-6 text-indigo-500 uppercase">
            Interactivo
          </p>
          <h4 class="mt-2 text-2xl font-extrabold leading-8 text-gray-900  sm:text-3xl sm:leading-9">
            La interacción entre nuestro talentoso equipo de restaurante es el ingrediente secreto de nuestro éxito.
          </h4>
          <p class="mt-4 text-xl leading-6 font-bold  text-gray-900 ">
            ¡Descubre el sabor supremo en nuestro restaurante! Deliciosos platos gourmet que deleitarán tus sentidos.
          </p>
          <ul class="gap-6 mt-8 md:grid md:grid-cols-2">
            <li class="mt-6 lg:mt-0">
              <div class="flex">
                <span class="flex items-center justify-center flex-shrink-0 w-6 h-6 text-green-800 bg-green-100 rounded-full  ">
                  <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd">
                    </path>
                  </svg>
                </span>
                <span class="ml-4 text-base font-medium leading-6 text-gray-900 ">
                  Reservas
                </span>
              </div>
            </li>
            <li class="mt-6 lg:mt-0">
              <div class="flex">
                <span class="flex items-center justify-center flex-shrink-0 w-6 h-6 text-green-800 bg-green-100 rounded-full  ">
                  <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd">
                    </path>
                  </svg>
                </span>
                <span class="ml-4 text-base font-medium leading-6 text-gray-900 ">
                  Autogestión
                </span>
              </div>
            </li>
          </ul>
        </div>
        <div class="relative mt-10 lg:-mx-4 relative-20 lg:mt-0 lg:col-start-1">
          <div class="relative space-y-4">
            <div class="flex items-end justify-center space-x-4 lg:justify-start">
              <img class="w-32 rounded-lg shadow-lg md:w-56" width="200" src="../assets/img/1.jpg" alt="1" />
              <img class="w-40 rounded-lg shadow-lg md:w-64" width="260" src="../assets/img/2.jpg" alt="2" />
            </div>
            <div class="flex items-start justify-center ml-12 space-x-4 lg:justify-start">
              <img class="w-24 rounded-lg shadow-lg md:w-40" width="170" src="../assets/img/3.jpg" alt="3" />
              <img class="w-32 rounded-lg shadow-lg md:w-56" width="200" src="../assets/img/4.jpg" alt="4" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>





  <script src="../js/main.js"></script>

</body>

</html>