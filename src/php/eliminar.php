<?php
require_once '../config/db_conexion.php';
require_once './session/session_start.php';


if (isset($_GET["id"])) {


    $reserva = mysqli_real_escape_string($conexion, $_GET["id"]);

    $sql = "SELECT id FROM usuarios where correo='{$_SESSION["correo"]}' ";
    $rest = mysqli_query($conexion, $sql);
    $contar = mysqli_num_rows($rest);
    if ($contar > 0) {
        $row = mysqli_fetch_assoc($rest);
        $id_user = $row["id"];
    } else {
        $id_user = 0;
    }

    $sql = "DELETE FROM reservas WHERE id='{$reserva}' AND id_usuario='{$id_user}'";
    mysqli_query($conexion, $sql);
    header("Location: reservas.php");
}
