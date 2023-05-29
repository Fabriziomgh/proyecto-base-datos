<?php
function validarCorreo($correo)
{
  global $conexion;
  $query = "SELECT correo FROM usuarios WHERE correo='$correo'";
  $ejecutarQuery = mysqli_query($conexion, $query);
  $contarUsuario = mysqli_num_rows($ejecutarQuery);

  return $contarUsuario > 0 ? true : false;
}

function validarLogin($correo, $clave, $rol)
{
  global $conexion;
  $query = "SELECT correo, id_rol FROM usuarios WHERE correo='$correo' and clave='$clave'";
  $ejecutarQuery = mysqli_query($conexion, $query);
  $contarLogin = mysqli_fetch_array($ejecutarQuery);

  if ($contarLogin['id_rol'] == $rol && $contarLogin['id_rol'] == 1) {
    return 'admin';
  } else if ($contarLogin['id_rol'] == $rol && $contarLogin['id_rol'] == 2) {
    return 'cliente';
  } else {
    return false;
  }
}
$msj = '';

function mensajeError($texto_1, $texto_2 = "")
{
  return '<div class="p-1 mb-1 text-sm text-red-800  rounded-lg  role="alert">
    <span class="font-medium">' . $texto_1 . '!</span> ' . $texto_2 . '.
  </div>';
}

function mensajeCorrecto($texto)
{
  return '<div class="p-1 mb-1 text-sm text-green-800 rounded-lg "role="alert">
    <span class="font-medium">' . $texto . '!</span> :).
  </div>';
}
