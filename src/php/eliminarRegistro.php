<?php
require_once '../config/db_conexion.php';
require_once './session/session_start.php';

if (!$_SESSION['rol'] == 1) {
    header('location: 404.php');
    exit();
}


if (isset($_GET["id"])) {


    $reserva = mysqli_real_escape_string($conexion, $_GET["id"]);

    $sqlRegistro = "SELECT * FROM `registro_reservas` where id_usuario ='$reserva'";
    $rest = mysqli_query($conexion, $sqlRegistro);
    $contar = mysqli_num_rows($rest);
    if ($contar > 0) {
        $row = mysqli_fetch_assoc($rest);
        $id_user = $row["id_usuario"];
        $id = $row['id'];
    }





    $sql = "DELETE FROM registro_reservas WHERE id_usuario='{$id_user}' and id='$id'";
    mysqli_query($conexion, $sql);







    header("Location: dashboard.php");
}
