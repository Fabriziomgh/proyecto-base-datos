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
    }


    $sqlMesa = "SELECT id_mesa FROM reservas where id='{$reserva}' and id_usuario='{$id_user}'";
    $restMesa = mysqli_query($conexion, $sqlMesa);

    if (mysqli_num_rows($restMesa) > 0) {
        $row = mysqli_fetch_assoc($restMesa);
        $mesa = $row["id_mesa"];
    }

    $sqlUpdateMesa =  "UPDATE mesas SET disponible='true'  WHERE id='{$mesa}'";
    mysqli_query($conexion, $sqlUpdateMesa);


    $sql = "DELETE FROM reservas WHERE id='{$reserva}' AND id_usuario='{$id_user}'";
    mysqli_query($conexion, $sql);







    header("Location: reservas.php");
}
