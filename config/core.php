<?php

// muestra el error del reporteador
error_reporting(E_ALL);

//Pagina de inicio
$page_inicio = "index.php";

//Pagina de inicio de sesión
$page_login = "login.php";

//Pagina de cierre de sesión
$page_logout = "logout.php";

//Pagina de registro
$page_registro = "registro.php";

// inicio d ela sesion en php
session_start();

// define la zona horaria por default
date_default_timezone_set('America/Mexico_City');

// la pagina del localhost de la web
$home_url = "http://localhost/ProyectoServidorWeb/";

//Ruta del archivo para registros
$path = "./recursos/datosRegistro.txt";

// pagina dada en el prametro de la url, por default es la pagina uno
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// establece el número de registros por página
$records_per_page = 5;

// calcula limite para la cláusula LIMIT en la consulta
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>
