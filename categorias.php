<?php

// configuración central
include_once "config/core.php";

// establecemos el título de la página
$page_title = "Gestión de Contenido";

// se incluye el verificador de inicio de sesión
$require_login = true;
include_once "login_checker.php";

// incluimos el HTML de encabezado de página
include_once "layout_head.php";

echo "<img src='./recursos/SITIO-EN-CONSTRUCCION.jpg' class='img-thumbnail'  width='300' height='300'>";

// pie de página 
include_once "layout_foot.php";