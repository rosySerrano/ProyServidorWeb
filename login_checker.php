<?php

// validacion de si $ require_login fue establecido y el valor es 'verdadero'
while(isset($require_login) && $require_login==true){
	// si el usuario aún no ha iniciado sesión, es redirigido a la página de inicio de sesión
	if(!isset($_SESSION['access_level'])){
		header("Location: {$home_url}login.php?action=please_login");
	}
}

?>
