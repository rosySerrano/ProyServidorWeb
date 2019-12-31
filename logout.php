<?php
// configuración central
include_once "config/core.php";

// con este comenado se eliminarán TODAS las configuraciones de sesión
session_destroy();

//redireccion a la página de inicio de sesión
header("Location: {$home_url}");
?>
