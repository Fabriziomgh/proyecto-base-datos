<?php
require_once '../../config/db_conexion.php';
require_once '../session/session_start.php';

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
    <link rel="stylesheet" href="../../css/output.css">
    <link rel="icon" href="../../assets/svg/restaurant-svgrepo-com.svg">
    <title>dashboard</title>
</head>


<body>





    <div class="relative ">
        <div class="flex   sm:flex-row ">
            <div class=" bg-gray-200  w-72">
                <div class="flex items-center justify-start mx-6 mt-10">
                    <img class="w-12" src="../../assets/svg/restaurant-svgrepo-com.svg">
                    <span class="text-gray-600  ml-4 text-2xl font-bold">
                        Admin
                    </span>
                </div>
                <nav class="mt-10 px-6 ">

                    <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors  duration-200  text-gray-800  rounded-lg  " href="../dashboard.php">
                        <div>
                            <img src="../../assets/svg/flecha-izquierda.svg">
                        </div>
                        <span class="mx-4 text-lg ">
                            General
                        </span>
                        <span class="flex-grow text-right">

                        </span>
                    </a>
                    <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors  duration-200  text-gray-600  rounded-lg " href="mesas.php">
                        <div>
                            <img src="../../assets/svg/table-svgrepo-com.svg">
                        </div>
                        <span class="mx-4 text-lg ">
                            Mesas
                        </span>
                        <span class="flex-grow text-right">

                        </span>
                    </a>

                </nav>
                <div class="absolute bottom-0 my-10">
                    <a class="text-gray-600  hover:text-gray-800  transition-colors duration-200 flex items-center py-2 px-8" href="../php/session/session_destroy.php">
                        <img src="../../assets/svg/flecha-izquierda.svg">
                        <span class="mx-4 font-medium">
                            Salir
                        </span>
                    </a>
                </div>
            </div>
            <div class="">


                <table class="table p-4 bg-white rounded-lg shadow">
                    <thead>
                        <tr>

                            <th class="border p-4  whitespace-nowrap font-normal text-gray-900">
                                Plato
                            </th>
                            <th class="border p-4  whitespace-nowrap font-normal text-gray-900">
                                Descripción
                            </th>
                            <th class="border p-4  whitespace-nowrap font-normal text-gray-900">
                                Ingredientes
                            </th>
                            <th class="border p-4  whitespace-nowrap font-normal text-gray-900">
                                Precio
                            </th>

                            <th class="border p-4  whitespace-nowrap font-normal text-gray-900">
                                Img
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT * FROM `menu`";
                        $response = mysqli_query($conexion, $sql);

                        if (mysqli_num_rows($response) > 0) {
                            foreach ($response as $dataMenu) {



                        ?>

                                <tr class="text-gray-700  [&>td]:w-[200px] text-center text-sm lowercase ">

                                    <td class="border  p-4 ">
                                        <?php echo $dataMenu['plato']; ?>
                                    </td>
                                    <td class="border p-4 ">
                                        <?php echo $dataMenu['descripcion']; ?>
                                    </td>
                                    <td class="border p-4 ">
                                        <?php echo $dataMenu['ingredientes']; ?>
                                    </td>
                                    <td class="border p-4 ">
                                        $<?php echo $dataMenu['precio']; ?>
                                    </td>
                                    <td class="border p-4 ">
                                        <img src="../<?php echo $dataMenu['img']; ?>">
                                    </td>
                                </tr>
                        <?php
                            }
                        } ?>

                    </tbody>
                </table>


            </div>
        </div>
    </div>
    <script src="../../js/main.js"></script>


</body>


</html>