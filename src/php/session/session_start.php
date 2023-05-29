<?php

session_start();

if (!isset($_SESSION['correo']) && !isset($_SESSION['nombre'])) {
  header('Location: login.php');
  die();
}
