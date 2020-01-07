<?php

// configuración central
include_once "config/core.php";

// establecemos el título de la página
$page_title = "Iniciar sesión";

// se incluye el verificador de inicio de sesión
$require_login = false;
include_once "login_checker.php";

// si se envia el formulario de inicio de sesión
if ($_POST) {

    $access_denied = true;

    $password = sha1(filter_input(INPUT_POST, "password"));
    $email = filter_input(INPUT_POST, "email");

    //Verificamos que exista el archivo de usuarios para buscar el registro
    if (file_exists($path)) {
        //Abrimos el archivo de registros para lectura
        $datosUsuarios = file($path);
    } else {
        echo "<br/><div class='alert alert-danger' role='alert'>Error al buscar el usuario. Intente nuevamente.</div>";
    }

    //Recorremos el archivo por linea hasta encontrar el correo y la contraseña dada
    foreach ($datosUsuarios as $num_línea => $línea) {
        //Separamos los datos de cada usuario
        $usuario = explode(",", $datosUsuarios[$num_línea]);

//        echo "Línea #<b>{$num_línea}</b> : " . htmlspecialchars($datosUsuarios[$num_línea]) . "<br />\n";
        //Se revisa si el correo o la contraseña se encuentra en el archivo de datos
        if ($usuario[0] == $email && $usuario[3] == $password) {

            $_SESSION['logged_in'] = true;
            $_SESSION['access_level'] = $usuario[4];
            $_SESSION['user_id'] = $num_línea;
            $_SESSION['user_name'] = $usuario[2];
            $access_denied = false;
            break;
        }
    }

    //No se encontro el usuario
    if ($access_denied) {
        echo "<div class='alert alert-danger margin-top-40' role='alert'>
                Acceso denegado.<br /><br />
                Su nombre de usuario o contraseña pueden ser incorrectos </div>";
    } else {
        
        switch (trim($usuario[4])) {
            case "Admin" : echo 'Administrador';
                header("Location: {$home_url}$page_admin?action=login_success");
                break;
            case "Gestor": header("Location: {$home_url}$page_gestor?action=login_success");
                break;
            case "Lector":
                header("Location: {$home_url}index.php?action=login_success");
                break;
        }
    }
}

// incluimos el HTML de encabezado de página
include_once "layout_head.php";

// obtenemos el valor de 'acciÃ³n' en el parÃ¡metro url para mostrar los mensajes de solicitud correspondientes
$action=isset($_GET['action']) ? $_GET['action'] : "";

// le decimos al usuario que aÃºn no ha iniciado sesiÃ³n
while ($action=='please_login'){
echo "<div class='alert alert-info'>
  <strong>Por favor inicie sesión.</strong>
</div><br/>";
$action = "";
}
echo "<div class='col-sm-6 col-md-4 col-md-offset-4'>";

// formulario de inicio de sesión HTML real
echo "<div class='account-wall'>";
echo "<div id='my-tab-content' class='tab-content'>";
echo "<div class='tab-pane active' id='login'>";
echo "<img class='profile-img' src='recursos/login.png'>";
echo "<form class='form-signin' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
echo "<input type='text' name='email' class='form-control' placeholder='Ingresa correo electrónico' required autofocus />";
echo "<input type='password' name='password' class='form-control' placeholder='Ingresa contraseña' required />";
echo "<input type='submit' class='btn btn-lg btn-primary btn-block' value='Iniciar Sesión' />";
echo "</form>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "<br/><br/>";

// pie de página 
include_once "layout_foot.php";
?>
