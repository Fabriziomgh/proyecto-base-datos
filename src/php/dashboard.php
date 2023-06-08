<?php
require_once '../config/db_conexion.php';
require_once './session/session_start.php';

if (!$_SESSION['rol'] == 1) {
    header('location: 404.php');
    exit();
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
    <title>dashboard</title>
</head>


<body>





    <div class="relative ">
        <div class="flex   sm:flex-row ">
            <div class="h-screen bg-gray-200  w-72">
                <div class="flex items-center justify-start mx-6 mt-10">
                    <img class="w-12" src="../assets/svg/restaurant-svgrepo-com.svg">
                    <span class="text-gray-600  ml-4 text-2xl font-bold">
                        Admin
                    </span>
                </div>
                <nav class="mt-10 px-6 ">
                    <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors   duration-200  text-gray-600  rounded-lg " href="#">
                        <div>
                            <img src="../assets/svg/bowl-svgrepo-com.svg">
                        </div>
                        <span class="mx-4 text-lg font-normal">
                            General
                        </span>
                        <span class="flex-grow text-right">
                        </span>
                    </a>
                    <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors  duration-200  text-gray-800  rounded-lg  " href="#">
                        <div>
                            <img src="../assets/svg/table-svgrepo-com.svg">
                        </div>
                        <span class="mx-4 text-lg font-normal">
                            Mesas
                        </span>
                        <span class="flex-grow text-right">

                        </span>
                    </a>
                    <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors  duration-200  text-gray-600  rounded-lg " href="#">
                        <div>
                            <img src="../assets/svg/bowl-svgrepo-com.svg">
                        </div>
                        <span class="mx-4 text-lg font-normal">
                            Menú
                        </span>
                        <span class="flex-grow text-right">

                        </span>
                    </a>

                </nav>
                <div class="absolute bottom-0 my-10">
                    <a class="text-gray-600  hover:text-gray-800  transition-colors duration-200 flex items-center py-2 px-8" href="../php/session/session_destroy.php">
                        <img src="../assets/svg/flecha-izquierda.svg">
                        <span class="mx-4 font-medium">
                            Salir
                        </span>
                    </a>
                </div>
            </div>
            <div>
                Reservas realizadas
                <div>

                    <div class="container max-w-3xl px-4 mx-auto sm:px-8">
                        <div class="py-8">
                            <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
                                <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                                    <table class="min-w-full leading-normal">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                                    Usuario
                                                </th>
                                                <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                                    Rol
                                                </th>
                                                <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                                    Creación
                                                </th>
                                                <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                                    Estado
                                                </th>
                                                <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <div class="flex items-center">

                                                        <div class="ml-3">
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                Jean marc
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        Admin
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        12/09/2020
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                                        <span aria-hidden="true" class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                                        </span>
                                                        <span class="relative">
                                                            active
                                                        </span>
                                                    </span>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <div class="flex items-center">

                                                        <div class="ml-3">
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                Marcus coco
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        Designer
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        01/10/2012
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                                        <span aria-hidden="true" class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                                        </span>
                                                        <span class="relative">
                                                            active
                                                        </span>
                                                    </span>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <div class="flex items-center">

                                                        <div class="ml-3">
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                Ecric marc
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        Developer
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        02/10/2018
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                                        <span aria-hidden="true" class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                                        </span>
                                                        <span class="relative">
                                                            active
                                                        </span>
                                                    </span>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <div class="flex items-center">

                                                        <div class="ml-3">
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                Julien Huger
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        User
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        23/09/2010
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                                        <span aria-hidden="true" class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                                        </span>
                                                        <span class="relative">
                                                            active
                                                        </span>
                                                    </span>
                                                </td>
                                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>






</html>