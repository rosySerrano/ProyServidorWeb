<?php
// Verificador de inicio de sesión para el nivel de acceso de el 'cliente'

// si el nivel de acceso no es 'Admin', es redirígido a la página de inicio de sesión
if(isset($_SESSION['access_level']) && $_SESSION['access_level']=="Admin"){
	header("Location: {$home_url}admin/index.php?action=logged_in_as_admin");
}

// validacion de si $ require_login fue establecido y el valor es 'verdadero'
else if(isset($require_login) && $require_login==true){
	// si el usuario aún no ha iniciado sesión, es redirigido a la página de inicio de sesión
	if(!isset($_SESSION['access_level'])){
		header("Location: {$home_url}login.php?action=please_login");
	}
}

// validacion de si era la página de 'iniciar sesión' o 'registrarse' o 'registrarse' pero el cliente ya había iniciado sesión
else if(isset($page_title) && ($page_title=="Login" || $page_title=="Sign Up")){
	// if user not yet logged in, redirect to login page
	if(isset($_SESSION['access_level']) && $_SESSION['access_level']=="Customer"){
		header("Location: {$home_url}index.php?action=already_logged_in");
	}
}

else{
	// no hay problema, puedes seguir en la pagina
}
?>
