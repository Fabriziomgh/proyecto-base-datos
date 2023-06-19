<?php
require_once '../config/db_conexion.php';
require_once '../php/session/session_start.php';

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


                    <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors  duration-200  text-gray-800  rounded-lg  " href="../php/dashboard.php">
                        <div>
                            <img src="../assets/svg/flecha-izquierda.svg">
                        </div>
                        <span class="mx-4 text-lg ">
                            General
                        </span>
                        <span class="flex-grow text-right">

                        </span>
                    </a>
                    <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors  duration-200  text-gray-600  rounded-lg " href="./menu.php">
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
            <div>



                <div class="relative w-full  p-4 overflow-hidden bg-white shadow-lg rounded-xl md:w-80 ">



                    <div class="flex items-center justify-between w-full mb-6">
                        <p class="text-xl font-medium text-gray-800 ">
                            Mesas
                        </p>




                    </div>
                    <div class="overflow-y-auto h-64
                    ">
                        <?php
                        if (isset($_POST['agregar-mesa'])) {
                            $reg = "/^(mesa|\d|\s)+$/i";
                            $mesa = mysqli_real_escape_string($conexion, trim($_POST['mesa']));

                            if (preg_match($reg, $mesa)) {
                                $sql = "INSERT INTO `mesas`(`mesa`) VALUES ('$mesa')";
                                $response = mysqli_query($conexion, $sql);
                            } else {
                                echo '<script>alert("Expresion incorrecta!")</script>';
                            }
                        }
                        ?>



                        <?php
                        $sql = "SELECT * FROM `mesas`";
                        $response = mysqli_query($conexion, $sql);


                        if (mysqli_num_rows($response) > 0) {
                            $clases = "";
                            $mesasDisponibles = 0;
                            $mesasNoDisponibles = 0;


                            foreach ($response as $mesas) {


                                if ($mesas['disponible'] == 'true') {
                                    $clases = 'bg-green-100';
                                    $mesasDisponibles += 1;
                                } else {
                                    $clases = 'bg-red-100';
                                    $mesasNoDisponibles += 1;
                                }

                        ?>
                                <div class="flex items-center justify-between p-3 mb-2 <?php
                                                                                        echo $clases;
                                                                                        ?> rounded">
                                    <span class="p-2  rounded-lg">
                                        <img src="../assets/svg/table-svgrepo-com.svg">
                                    </span>
                                    <div class="flex items-center justify-between w-full ml-2">

                                        <p>
                                            <?php echo ucfirst(strtolower($mesas['mesa']));
                                            ?>
                                        </p>
                                        <p>

                                            <?php
                                            if ($mesas['disponible'] == 'true') {
                                                echo 'Disponible';
                                            } else {
                                                echo 'No disponible';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                        <?php
                            }
                        }

                        ?>

                    </div>


                    <div class="flex flex-col gap-2">
                        <form method="POST" class=" flex flex-col justify-center w-3/4 max-w-sm space-y-3 md:flex-row md:w-full md:space-x-3 md:space-y-0">
                            <div class=" relative ">
                                <input type="text" name="mesa" class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="Agregar mesa" />
                            </div>
                            <button class="btn-form-enviar flex-shrink-0 px-4 py-2 text-base font-semibold text-white bg-purple-600 rounded-lg shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-purple-200" name="agregar-mesa" type="submit">
                                Agregar
                            </button>
                        </form>

                        <span class="px-4 py-2  text-base rounded-full text-green-500 border border-green-500  ">
                            Disponibles : <?php echo $mesasDisponibles; ?>
                        </span>
                        <span class="px-4 py-2  text-base rounded-full text-red-500 border border-red-500  ">
                            No disponibles : <?php echo $mesasNoDisponibles; ?>
                        </span>


                    </div>

                </div>

            </div>

        </div>


    </div>

    <script src="../../js/main.js"></script>
</body>



</html>