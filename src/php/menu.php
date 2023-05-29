<?php
require_once '../config/db_conexion.php';
require_once './session/session_start.php';


$consulta = "SELECT * FROM `menu` ";
$ejecutarConsulta = mysqli_query($conexion, $consulta);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <title>Menú</title>
</head>

<body>
    <div class="pl-2 pt-2">
        <a class="flex items-center gap-2 px-4 py-2 text-base font-medium text-white bg-purple-600 rounded-md w-28 hover:bg-purple-500" href="./inicio.php">
            <img src="../assets/svg/flecha-izquierda.svg">Atrás</a>
    </div>
    <div>
        <h1 class="text-4xl font-bold text-center p-10">Nuestro <span class="text-purple-600 italic">Menú</span></h1>
    </div>


    <div class="flex flex-wrap items-center justify-center gap-10 py-4">
        <?php
        if (mysqli_num_rows($ejecutarConsulta) > 0) {
            foreach ($ejecutarConsulta as $platos) {
        ?>
                <div class="w-full max-w-sm bg-white  rounded-lg shadow  ">
                    <span>
                        <img class=" h-52 w-full mb-2 rounded-t-lg" src="<?php echo $platos['img'] ?>" />
                    </span>
                    <div class="px-5 pb-5">
                        <span>
                            <h5 class="border-b border-purple-600 text-sm font-bold tracking-tight text-gray-900 "><?php echo $platos['plato']; ?></h5>
                            <p><span class="font-bold">Descripción: </span><?php echo $platos['descripcion'] ?></p>
                            <p class="italic"><span class="font-bold">Ingredientes: </span><?php echo $platos['ingredientes'] ?></p>
                        </span>
                        <div class="flex items-center mt-2.5 mb-5">
                            <div class="flex">
                                <?php
                                for ($i = 0; $i < $platos['popularidad']; $i++) {
                                    echo '<img src="../assets/svg/estrella.svg">';
                                };
                                ?>
                            </div>

                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded  ml-3"><?php echo $platos['popularidad'] ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold text-gray-900 ">$<?php echo $platos['precio'] ?></span>

                        </div>
                    </div>
                </div><?php
                    }
                }
                        ?>
    </div>
</body>

</html>