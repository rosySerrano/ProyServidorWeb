<?php
// configuración central
include_once "config/core.php";

// establecemos el título de la página
$page_title="Descarga Libros Online";

// incluimos el verificador de inicio de sesión
$require_login=false;
include_once "login_checker.php";

// incluimos HTML de encabezado de página
include_once 'layout_head.php';

echo "<div class='col-md-12'>";

	// evitamos aviso de índices indefinidos
	$action = isset($_GET['action']) ? $_GET['action'] : "";

	// si el inicio de sesión fue exitoso
	if($action=='login_success'){
		echo "<div class='alert alert-info'>";
			echo "<strong>Hola " . $_SESSION['user_name'] . "</strong>";
		echo "</div>";
	}

	// si el usuario ya inició sesión, se muestra aviso que  el usuario intenta acceder a la página ya inicio de sesión
	else if($action=='already_logged_in'){
		echo "<div class='alert alert-info'>";
			echo "<strong>You are already logged in.</strong>";
		echo "</div>";
	}

	// contenido una vez conectado
	echo "<div class='alert alert-info'>";
		echo "Content when logged in will be here. For example, your premium products or services.";
	echo "</div>";

echo "</div>";

// pie de página códigos HTML y JavaScript
include 'layout_foot.php';
?>
