<?php
require_once '../config/db_conexion.php';
require_once '../config/functions.php';
session_start();


if (isset($_POST['entrar'])) {
    $correo = $_POST['correo'];
    $clave = md5($_POST['clave']);
    $rol = $_POST['rol'];

    $query = "SELECT nombre FROM usuarios WHERE correo='$correo' and clave='$clave'";
    $ejecutarQuery = mysqli_query($conexion, $query);
    $contarLogin = mysqli_fetch_array($ejecutarQuery);


    if (validarCorreo($correo)) {

        if (validarLogin($correo, $clave, $rol) == 'admin') {
            $_SESSION['correo'] = $correo;
            $_SESSION['rol'] = $rol;



            header("location: dashboard.php");
            die();
        } else if (validarLogin($correo, $clave, $rol) == 'cliente') {

            if ($contarLogin['nombre'] > 0) {
                $nombre = ucfirst(strtolower($contarLogin['nombre']));
                $_SESSION['correo'] = $correo;
                $_SESSION['nombre'] = $nombre;
            }
            header("location: inicio.php");
            die();
        } else {
            $msj = mensajeError('Clave invalida', 'intenta otra vez :(');
        }
    } else {
        $msj = mensajeError('Correo invalido', 'intenta otra vez :(');
    }
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
    <title>Login</title>
</head>

<body class="flex items-center justify-center h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('../assets/img/8.jpg')">

    <div class="flex flex-col w-full max-w-md px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10">
        <div class="self-center  text-xl font-light text-gray-600 sm:text-2xl ">
            Acceda a su cuenta
            <?php echo $msj; ?>
        </div>
        <div class="mt-8">
            <form method="POST" action="">

                <div class="flex flex-col mb-2">
                    <div class="flex relative ">
                        <span class="rounded-l-md inline-flex  items-center px-3 border-t bg-white border-l border-b  border-gray-300 shadow-sm text-sm">
                            <img src="../assets/svg/email.svg" alt="">
                        </span>
                        <input name="correo" type="text" class=" rounded-r-lg flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="Tú correo" />
                    </div>
                </div>
                <div class="flex flex-col mb-6">
                    <div class="flex relative ">
                        <span class="rounded-l-md inline-flex  items-center px-3 border-t bg-white border-l border-b  border-gray-300  shadow-sm text-sm">
                            <img src="../assets/svg/candado.svg" alt="">
                        </span>
                        <input name="clave" type="password" class=" rounded-r-lg flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="Tú contraseña" />
                    </div>
                </div>
                <div>
                    <label class="flex text-gray-700 " for="rol">
                        <span class="rounded-l-md inline-flex  items-center px-3 border-t bg-white border-l border-b  border-gray-300  shadow-sm text-sm">
                            <img src="../assets/svg/person-svgrepo-com.svg" alt="">
                        </span>
                        <select id="rol" class="w-40 block px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" name="rol">
                            <option selected value="2">
                                Cliente
                            </option>
                            <option value="1">
                                Administrador
                            </option>
                        </select>
                    </label>
                </div>
                <div class="flex items-center mb-6 -mt-4">
                    <div class="flex ml-auto">
                        <a href="./recuperarContraseña.php" class="inline-flex text-xs font-thin text-gray-500 sm:text-sm  hover:text-gray-700 ">
                            Olvidó su contraseña?
                        </a>
                    </div>
                </div>
                <div class="flex w-full">
                    <button name="entrar" type="submit" class="py-2 px-4  bg-purple-600 hover:bg-purple-700 focus:ring-purple-500 focus:ring-offset-purple-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
        <div class="flex items-center justify-center mt-6">
            <a href="../php/register.php" target="_blank" class="inline-flex items-center  font-normal text-center text-black hover:text-gray-700 ">
                <span class="ml-2">
                    Crear cuenta
                </span>
            </a>
        </div>
    </div>


</body>

</html>