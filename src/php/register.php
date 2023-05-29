<?php
require_once '../config/db_conexion.php';
require_once '../config/functions.php';

$patron_nombre = "/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+$/";
$patron_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$patron_clave = "/^[a-zA-Z0-9]{8,}$/";
$msj = '';

if (isset($_POST['registrar'])) {

    $nombre = strtoupper(trim($_POST['nombre']));
    $correo = strtoupper(trim($_POST['email']));
    $clave = md5($_POST['password']);

    if (!preg_match($patron_nombre, $nombre)) {
        $msj = mensajeError('Nombre invalido!', 'No se aceptan caracteres especiales');
    }

    if (!preg_match($patron_email, $correo)) {
        $msj = mensajeError('Correo invalido :(');
    }

    $consulta = "SELECT * FROM usuarios WHERE correo='$correo'";
    $verificar_consulta = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($verificar_consulta) > 0) {
        $msj = mensajeError('Correo ya existente!', 'intenta con otro.');
    }

    if (!preg_match($patron_clave, $clave)) {
        $msj = mensajeError('Clave muy insegura!', 'utiliza números y letras.');
    }

    if (!$msj) {

        $cliente = "SELECT id FROM roles WHERE rol='Cliente'";
        $clienteConsulta = mysqli_query($conexion, $cliente);
        $resultado = mysqli_fetch_array($clienteConsulta);
        $fila = $resultado['id'];

        $datos = "INSERT INTO usuarios (nombre,correo, clave, id_rol) VALUES ('$nombre','$correo', '$clave', '$fila')";
        $insertarDatos = mysqli_query($conexion, $datos);

        $msj = mensajeCorrecto('Registrado correctamente');
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
    <title>Registrar</title>
</head>


<body class=" bg-cover bg-center bg-no-repeat" style="background-image: url('../assets/img/8.jpg')">
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0  ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                        Crear una cuenta
                    </h1>
                    <?php echo $msj; ?>
                    <form method="POST" action="" class="space-y-4 md:space-y-6">
                        <div>
                            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 ">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5      " placeholder="Fabrizio Gutierrez" required="">

                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Correo</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5      " placeholder="correo@correo.com" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Contraseña</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5      " required="">
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
                            <button name="registrar" type="submit" class="py-2 px-4  bg-purple-600 hover:bg-purple-700 focus:ring-purple-500 focus:ring-offset-purple-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                Crear cuenta
                            </button>
                        </div>
                        <p class="text-sm font-light text-gray-500 ">
                            Ya tienes una cuenta? <a href="./login.php" class="font-medium text-primary-600 hover:underline ">Entra aquí</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>