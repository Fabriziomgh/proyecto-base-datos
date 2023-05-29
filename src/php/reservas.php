<?php
require_once '../config/db_conexion.php';
require_once './session/session_start.php';
$msj = "";
if (isset($_POST['reservar'])) {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $mesa = $_POST['mesas'];

    $sql = "SELECT id FROM usuarios where correo='{$_SESSION["correo"]}' ";

    $rest = mysqli_query($conexion, $sql);
    $contar = mysqli_num_rows($rest);
    if ($contar > 0) {
        $row = mysqli_fetch_assoc($rest);
        $id_user = $row["id"];
    } else {
        $id_user = 0;
    }
    $sql = null;

    $sqlMesa = "SELECT id FROM mesas where mesa='$mesa'";
    $respuestaMesa = mysqli_query($conexion, $sqlMesa);
    $contarMesa = mysqli_num_rows($respuestaMesa);

    $sql = "INSERT INTO reservas (fecha, hora, mesa, id_usuario) VALUES ('$fecha', '$hora','$mesa','$id_user')";
    $rest = mysqli_query($conexion, $sql);
    if ($rest && $contarMesa > 0) {
        $row = mysqli_fetch_assoc($respuestaMesa);
        $id_mesa = $row["id"];
        $sM = "UPDATE mesas SET disponible='false'  WHERE id='{$id_mesa}'";
        $r = mysqli_query($conexion, $sM);

        $msj = '<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 " role="alert">
        <span class="font-medium">Reservación completada!</span> .
      </div>';
    } else {
        $msj = '<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 " role="alert">
        <span class="font-medium">Danger alert!</span> Change a few things up and try submitting again.
      </div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <link rel="icon" href="../assets/svg/restaurant-svgrepo-com.svg">
    <title>Reservas</title>
</head>

<body>
    <header class="text-sm mb-6 font-medium text-center text-gray-500 border-b border-gray-200 ">
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

    <div class="relative p-4 bg-white ">
        <form class="lg:grid lg:grid-flow-row-dense lg:grid-cols-2 lg:gap-12 lg:items-center" action="" method="post">
            <div class="lg:col-start-2 md:pl-20">
                <div class="flex flex-col items-center">
                    <h3 class="text-center text-2xl mb-4">Mi reservación</h3>
                    <?php
                    $sql = "SELECT id FROM usuarios where correo='{$_SESSION["correo"]}' ";
                    $rest = mysqli_query($conexion, $sql);
                    $contar = mysqli_num_rows($rest);
                    if ($contar > 0) {
                        $row = mysqli_fetch_assoc($rest);
                        $id_user = $row["id"];
                    } else {
                        $id_user = 0;
                    }

                    $sql1 = "SELECT * FROM reservas where id_usuario='{$id_user}' ORDER BY id DESC";

                    $rest1 = mysqli_query($conexion, $sql1);

                    if (mysqli_num_rows($rest1) > 0) {
                        foreach ($rest1 as $reserva) {
                            $newDate = date("d/m/Y", strtotime($reserva['fecha']));
                    ?>
                            <div class="w-64 p-4 bg-white shadow-lg rounded-2xl 
                        <p class=" mb-4 text-xl font-medium text-gray-800 ">
                            Fecha
                        </p>
                        <p class=" text-3xl font-bold text-gray-900 ">
                        <?php echo $newDate ?>
                            
                        </p>
                        
                        <ul class=" w-full mt-6 mb-6 text-sm text-gray-600 ">
                            <li class=" gap-2 mb-3 flex items-center ">
                                <img src=" ../assets/svg/check.svg">
                                Hora: <?php echo $reserva['hora'] ?>
                                </li>
                                <li class=" gap-2 mb-3 flex items-center ">
                                    <img src=" ../assets/svg/check.svg">

                                    <?php echo ucfirst(strtolower($reserva['mesa'])) ?>
                                </li>

                                </ul>
                                <div class="flex gap-2">
                                    <button type="button" class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                        Editar
                                    </button>
                                    <button type="button" class="py-2 px-4 bg-red-400 hover:bg-red-600 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                        Cancelar
                                    </button>
                                </div>
                            </div><?php

                                }
                            } else {
                                    ?>
                        <h1>Sin reservaciones</h1>
                    <?php
                            }
                    ?>


                </div>
            </div>
            <div class="relative mt-10 -mx-4 md:-mx-12 lg:mt-0 lg:col-start-1">
                <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                    <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0  ">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <?php echo $msj; ?>
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                                Reservar
                            </h1>

                            <div class="space-y-4 md:space-y-6">
                                <div>
                                    <label for="fecha" class="block mb-2 text-sm font-medium text-gray-900 ">Fecha</label>
                                    <input type="date" name="fecha" id="fecha" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">

                                </div>
                                <div>
                                    <label for="hora" class="block mb-2 text-sm font-medium text-gray-900 ">Hora</label>
                                    <select type="hora" name="hora" id="hora" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5      " required="">
                                        <option value="">----</option>
                                        <option value="18:00">18:00</option>
                                        <option value="19:00">19:00</option>
                                        <option value="20:00">20:00</option>
                                        <option value="21:00">21:00</option>
                                        <option value="22:00">22:00</option>
                                        <option value="23:00">23:00</option>
                                    </select>
                                </div>
                                <div>
                                    <?php

                                    $consulta = "SELECT * FROM `mesas` ";
                                    $ejecutarConsulta = mysqli_query($conexion, $consulta);

                                    if (mysqli_num_rows($ejecutarConsulta) > 0) {
                                    ?>
                                        <label for="mesas" class="block mb-2 text-sm font-medium text-gray-900 ">Mesas disponibles</label>
                                        <select required name="mesas" id="mesas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                            <option selected>Seleccione una opción.</option>
                                            <?php
                                            foreach ($ejecutarConsulta as $mesas) {
                                                $m = ucfirst(strtolower($mesas['mesa']));
                                                if ($mesas['disponible'] == 'true') {
                                            ?>
                                                    <option value="<?php echo $mesas['mesa'] ?>"><?php echo $m ?></option>

                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                        </select>

                                </div>



                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300    " required="">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="terms" class="font-light text-gray-500 ">Acepto los <a class="font-medium text-primary-600 hover:underline d" href="#">términos y condiciones</a></label>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <button name="reservar" type="submit" class="py-2 px-4  bg-purple-600 hover:bg-purple-700 focus:ring-purple-500 focus:ring-offset-purple-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                        Reservar
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="../js/main.js"></script>
</body>

</html>