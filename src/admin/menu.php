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
            <div class=" bg-gray-200  w-60">
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
                    <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors  duration-200  text-gray-600  rounded-lg " href="mesas.php">
                        <div>
                            <img src="../assets/svg/table-svgrepo-com.svg">
                        </div>
                        <span class="mx-4 text-lg ">
                            Mesas
                        </span>
                        <span class="flex-grow text-right">

                        </span>
                    </a>
                    <button id="btn-open-modal" class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors  duration-200  text-gray-600  rounded-lg ">
                        <div>
                            <img src="../assets/svg/plus.svg">
                        </div>
                        <span class="mx-4 text-lg ">
                            Agregar Menú
                        </span>
                        <span class="flex-grow text-right">

                        </span>
                    </button>
                    <button id="btn-open-modal-eliminar" class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors  duration-200  text-gray-600  rounded-lg ">
                        <div>
                            <img src="../assets/svg/plus.svg">
                        </div>
                        <span class="mx-4 text-lg ">
                            Eliminar Menú
                        </span>
                        <span class="flex-grow text-right">

                        </span>
                    </button>

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

                <?php
                if (isset($_POST['registrar-menu'])) {
                    $reg = '/^[a-zA-Z0-9\s,.!?"\'@#$%&*()_+-=:;<>{}[\]\\/]*$/';

                    $plato = mysqli_real_escape_string($conexion, trim($_POST['plato']));
                    $descripcion = mysqli_real_escape_string($conexion, trim($_POST['descripcion']));
                    $ingredientes = mysqli_real_escape_string($conexion, trim($_POST['ingredientes']));
                    $precio = mysqli_real_escape_string($conexion, trim($_POST['precio']));
                    $img = $_FILES['img']['name'];

                    $carpeta_destino = '../assets/img/';
                    $ruta_destino = $carpeta_destino . basename($img);
                    move_uploaded_file($_FILES['img']['tmp_name'], $ruta_destino);


                    if (
                        preg_match($reg, $plato) &&
                        preg_match($reg, $descripcion) &&
                        preg_match($reg, $ingredientes) &&
                        preg_match($reg, $precio)
                    ) {
                        $sql = "INSERT INTO `menu`(`plato`, `descripcion`, `ingredientes`, `precio`,  `img`) VALUES ('$plato','$descripcion','$ingredientes','$precio','$ruta_destino')";
                        $response = mysqli_query($conexion, $sql);

                        echo '<script>
                            alert("Se ha agredado correctamente el nuevo menú");
                        </script>';
                    } else {
                        echo '<script>
                            alert("Formulario para agregar nuevo menú es invalido, asegurate de que los valores sean correctos!");
                        </script>';
                    }
                }
                ?>

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
                                        <img src="<?php echo $dataMenu['img']; ?>">
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
    <div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 hidden  right-0 z-50  w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full  ">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow  border border-purple-600">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t ">
                    <h3 class="text-xl font-semibold text-gray-900 ">
                        Agregar nuevo menú
                    </h3>
                    <button id="btn-close-modal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center  " data-modal-hide="staticModal">
                        <img src="../assets/svg/x.svg">
                    </button>
                </div>

                <div class="p-6 space-y-6">



                    <form method="POST" enctype="multipart/form-data">
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="text" name="plato" id="plato" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " required />
                            <label for="plato" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-purple-600 peer-focus:peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre del plato</label>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="text" name="descripcion" id="descripcion" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " required />
                            <label for="descripcion" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-purple-600 peer-focus:peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Descripción</label>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="text" name="ingredientes" id="floating_ingredientes" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " required />
                            <label for="floating_ingredientes" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-purple-600 peer-focus:peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Ingredientes</label>
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="precio" id="precio" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " required />
                                <label for="precio" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-purple-600 peer-focus:peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Precio</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="file" name="img" id="img" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " required />
                                <label for="img" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-purple-600 peer-focus:peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Img</label>
                            </div>
                        </div>

                        <button type="submit" name="registrar-menu" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Agregar</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <div id="modal-eliminar-menu" tabindex="-1" class="fixed hidden top-0 left-0 right-0 z-50  w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-lg max-h-full">

            <div class="relative bg-white rounded-lg shadow border border-purple-600  ">
                <div class="flex items-center justify-between p-2  border-b rounded-t ">
                    <h3 class="text-xl  font-medium text-gray-900 ">
                        Eliminar Menú
                    </h3>
                    <button id="btn-close-modal-eliminar" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center " data-modal-hide="small-modal">
                        <img src="../assets/svg/x.svg">
                        <span class="sr-only"></span>
                    </button>
                </div>

                <div class=" space-y-6">

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Plato
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Acción
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
                                        <tr class="bg-white border-b  ">
                                            <th scope="row" class="px-6 py-4  font-medium text-gray-900 whitespace-nowrap ">
                                                <?php echo $dataMenu["plato"]; ?>
                                            </th>
                                            <td class="px-6 py-4">
                                                <a href="../php/eliminarMenu.php?id=<?php echo $dataMenu["id"]; ?>">Eliminar</a>
                                            </td>

                                        </tr>
                                <?php
                                    }
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>


</body>


</html>