<?php
require_once '../config/db_conexion.php';
require_once '../php/session/session_start.php';

if (!$_SESSION['rol'] == 1) {
    header('location: 404.php');
    exit();
}


if (isset($_GET["id"])) {


    $menuId = mysqli_real_escape_string($conexion, $_GET["id"]);

    $sqlRegistro = "SELECT * FROM `menu` where id ='$menuId'";
    $rest = mysqli_query($conexion, $sqlRegistro);
    $contar = mysqli_num_rows($rest);
    if ($contar > 0) {
        $row = mysqli_fetch_assoc($rest);
        $id = $row['id'];
    }





    $sql = "DELETE FROM menu WHERE  id='$id'";
    mysqli_query($conexion, $sql);







    header("Location: ../admin/menu.php");
}
