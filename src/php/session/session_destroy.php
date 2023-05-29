<?php
    session_start();
    unset($_SESSION['correo']);
    session_destroy();
    header("location: ../login.php");
?>