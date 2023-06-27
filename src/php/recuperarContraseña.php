<?php
require_once '../config/db_conexion.php';

use PHPMailer\PHPMailer\PHPMailer;

require '../../vendor/autoload.php';
$msj = '<p class="self-center   font-light text-gray-600">Te enviaremos un correo para recuperar tu contraseña.</p>';
function sendMail($correo, $nombre, $clave)
{
    $mail = new PHPMailer(true);




    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'restaurante1900f@gmail.com';
    $mail->Password   = 'owigdnpgenyuaove';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->setFrom('restaurante1900f@gmail.com', 'Restaurante');
    $mail->addAddress($correo, $nombre);

    $mail->isHTML(true);
    $mail->Subject = 'Recuperar contraseña';
    $mail->Body    = 'Hola ' . $nombre . ' <b>tu clave es: ' . $clave . '</b>';


    $mail->send();
}

if (isset($_POST["recuperar"])) {


    $email = mysqli_real_escape_string($conexion, (trim($_POST["correo"])));
    $consulta = "SELECT * FROM usuarios WHERE correo = '$email'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {

        $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $nuevacontraseña = substr(str_shuffle($caracteres), 0, 10);

        $hash = md5($nuevacontraseña);
        $fila = mysqli_fetch_assoc($resultado);
        $id = $fila["id"];
        $nombre = $fila['nombre'];
        $actualizar = "UPDATE usuarios SET clave = '$hash' WHERE id = $id";
        mysqli_query($conexion, $actualizar);


        sendMail($email, $nombre, $nuevacontraseña);

        $msj = '<p class="self-center text-green-600   font-light">Se ha enviado un correo electrónico con la nueva contraseña. <a href="./login.php">Login</a></p>';
    } else {
        $msj = '<p class="self-center text-red-600   font-light">No se encontró ninguna cuenta con ese correo electrónico...  </p>';
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
    <title>Recuperar contraseña</title>
</head>

<body class="flex items-center justify-center h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('../assets/img/8.jpg')">

    <div class="flex flex-col w-full max-w-md px-2 py-5 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10">
        <div class="self-center  text-xl font-light text-gray-600 sm:text-2xl ">
            Correo electrónico
        </div>
        <?php echo $msj; ?>
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



                <div class="flex w-full">
                    <button name="recuperar" type="submit" class="py-2 px-4  bg-purple-600 hover:bg-purple-700 focus:ring-purple-500 focus:ring-offset-purple-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                        Recuperar
                    </button>
                </div>
            </form>
        </div>

    </div>

</body>