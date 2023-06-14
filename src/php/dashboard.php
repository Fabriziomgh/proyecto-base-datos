<?php
require_once '../config/db_conexion.php';
require_once './session/session_start.php';

if (!$_SESSION['rol'] == 1) {
    header('location: 404.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <link rel="icon" href="../assets/svg/restaurant-svgrepo-com.svg">
    <title>dashboard</title>
</head>


<body>





    <div class="relative ">
        <div class="flex   sm:flex-row ">
            <div class="h-screen bg-gray-200  w-72">
                <div class="flex items-center justify-start mx-6 mt-10">
                    <img class="w-12" src="../assets/svg/restaurant-svgrepo-com.svg">
                    <span class="text-gray-600  ml-4 text-2xl font-bold">
                        Admin
                    </span>
                </div>
                <nav class="mt-10 px-6 ">
                    <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors   duration-200  text-gray-600  rounded-lg " href="#">
                        <div>
                            <img src="../assets/svg/bowl-svgrepo-com.svg">
                        </div>
                        <span class="mx-4 text-lg ">
                            General
                        </span>
                        <span class="flex-grow text-right">
                        </span>
                    </a>
                    <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors  duration-200  text-gray-800  rounded-lg  " href="#">
                        <div>
                            <img src="../assets/svg/table-svgrepo-com.svg">
                        </div>
                        <span class="mx-4 text-lg ">
                            Mesas
                        </span>
                        <span class="flex-grow text-right">

                        </span>
                    </a>
                    <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors  duration-200  text-gray-600  rounded-lg " href="#">
                        <div>
                            <img src="../assets/svg/bowl-svgrepo-com.svg">
                        </div>
                        <span class="mx-4 text-lg ">
                            Menú
                        </span>
                        <span class="flex-grow text-right">

                        </span>
                    </a>

                </nav>
                <div class="absolute bottom-0 my-10">
                    <a class="text-gray-600  hover:text-gray-800  transition-colors duration-200 flex items-center py-2 px-8" href="../php/session/session_destroy.php">
                        <img src="../assets/svg/flecha-izquierda.svg">
                        <span class="mx-4 font-medium">
                            Salir
                        </span>
                    </a>
                </div>
            </div>
            <div class="">
                <div class="">
                    <h2 class=" text-3xl text-center font-bold">Reservas realizadas</h2>
                </div>
                <div class="">

                    <div class="container max-w-3xl px-4 mx-auto sm:px-8">
                        <div class="py-8">
                            <div class="flex flex-row justify-between w-full mb-1 sm:mb-0">
                                <h2 class="text-2xl leading-tight">Usuarios</h2>
                                <div class="text-end">
                                    <form method="GET" class="flex flex-col justify-center w-3/4 max-w-sm space-y-3 md:flex-row md:w-full md:space-x-3 md:space-y-0">
                                        <div class=" relative ">
                                            <input type="text" name="buscador" id="" class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="...">
                                        </div>
                                        <input name="buscar" class="flex-shrink-0 px-4 py-2 text-base font-semibold text-white bg-purple-600 rounded-lg shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-purple-200" type="submit" />

                                    </form>
                                </div>
                            </div>
                            <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
                                <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                                    <table class="min-w-full leading-normal">
                                        <thead>
                                            <tr class="font-bold">
                                                <th scope="col" class="px-5 py-3 text-sm  text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                                    ID
                                                </th>
                                                <th scope="col" class="px-5 py-3 text-sm  text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                                    Usuario
                                                </th>
                                                <th scope="col" class="px-5 py-3 text-sm  text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                                    Rol
                                                </th>
                                                <th scope="col" class="px-5 py-3 text-sm  text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                                    Correo
                                                </th>
                                                <th scope="col" class="px-5 py-3 text-sm  text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                                    Fecha
                                                </th>
                                                <th scope="col" class="px-5 py-3 text-sm  text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                                    Hora
                                                </th>
                                                <th scope="col" class="px-5 py-3 text-sm  text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php



                                            $offset = 0;
                                            $pagina = 1;

                                            if (isset($_GET["pagina"])) {
                                                $pagina = $_GET["pagina"];
                                                $offset = ($pagina - 1) * 4;
                                            }

                                            $where = "";
                                            if (isset($_GET['buscar'])) {
                                                $buscar = mysqli_real_escape_string($conexion, trim($_GET['buscador']));
                                                $where = "WHERE nombre LIKE '%$buscar%' OR correo LIKE '%$buscar%'";
                                            }

                                            $sqlRegistro = "SELECT * FROM `registro_reservas` JOIN `usuarios` ON registro_reservas.id_usuario = usuarios.id $where LIMIT 4 OFFSET $offset";
                                            $response = mysqli_query($conexion, $sqlRegistro);





                                            if (mysqli_num_rows($response) > 0) {
                                                foreach ($response as $data) {
                                                    $newDate = date("d/m/Y", strtotime($data['fecha']));



                                            ?>
                                                    <tr data-id="<?php echo $data['id'] ?>" class="uppercase">
                                                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                <?php echo $data['id'] ?>
                                                            </p>
                                                        </td>
                                                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                <?php echo $data['nombre'] ?>
                                                            </p>
                                                        </td>
                                                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                <?php echo $data['rol'] ?>
                                                            </p>
                                                        </td>
                                                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                <?php echo $data['correo'] ?>
                                                            </p>
                                                        </td>
                                                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                <?php echo $newDate ?>
                                                            </p>
                                                        </td>
                                                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                            <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                                                <span aria-hidden="true" class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                                                </span>
                                                                <span class="relative">
                                                                    <?php echo $data['hora'] ?>
                                                                </span>
                                                            </span>
                                                        </td>
                                                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                                                <img src="../assets/svg/garbage-svgrepo-com.svg">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php

                                                }
                                            } else {
                                                ?>
                                                <h1 class="w-full text-center">Sin reservaciones</h1>
                                            <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>


                                    <?php
                                    $totalRegistros = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM `registro_reservas` JOIN `usuarios` ON registro_reservas.id_usuario = usuarios.id $where  "));
                                    $numPaginas = ($totalRegistros / 4);






                                    ?>





                                </div>
                                <div class="flex justify-center gap-2">
                                    <?php
                                    if ($pagina > 1) {
                                        echo '<a class="inline-block bg-gray-200 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l"  href="' . $_SERVER['PHP_SELF'] . '?pagina=' . ($pagina - 1) . '">Anterior</a> ';
                                    }

                                    if ($pagina < $numPaginas) {
                                        echo '<a class="inline-block bg-gray-200 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l"  href="' . $_SERVER['PHP_SELF'] . '?pagina=' . ($pagina + 1) . '">Siguiente</a> ';
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>






</html>