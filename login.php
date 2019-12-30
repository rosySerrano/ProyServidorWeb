<?php

// configuración central
include_once "config/core.php";

// establecemos el título de la página
$page_title = "Iniciar sesión";

// se incluye el verificador de inicio de sesión
$require_login = false;
include_once "login_checker.php";

// predeterminado a  valor falso
$access_denied = false;

// si se envia el formulario de inicio de sesión
if ($_POST) {

    //Verificamos que exista el archivo de usuarios para buscar el registro
    if (file_exists($path)) {
        //Abrimos el archivo de registros para lectura
        $fileUsuarios = fopen($path, "r");
    } else {
        echo "<br/><div class='alert alert-danger' role='alert'>Error al buscar el usuario. Intente nuevamente.</div>";
    }




    // verifica si el correo electrónico y la contraseña están en la base de datos
    $user->email = $_POST['email'];

    // comprueba si existe un correo electrónico, también obtén detalles del usuario utilizando este comando
    $email_exists = $user->emailExists();

    // validacion de inicio de sesión
    if ($email_exists && password_verify($_POST['password'], $user->password) && $user->status == 1) {

        // si es correcto, establece el valor de la sesión en verdadero
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user->id;
        $_SESSION['access_level'] = $user->access_level;
        $_SESSION['firstname'] = htmlspecialchars($user->firstname, ENT_QUOTES, 'UTF-8');
        $_SESSION['lastname'] = $user->lastname;

        // si el nivel de acceso es 'Admin', redirija a la sección de administrador
        if ($user->access_level == 'Admin') {
            header("Location: {$home_url}admin/index.php?action=login_success");
        }

        // de lo contrario, redirija solo a la sección 'Cliente'
        else {
            header("Location: {$home_url}index.php?action=login_success");
        }
    }

// si el nombre de usuario no existe o la contraseña es incorrecta
    else {
        $access_denied = true;
    }
}

// incluimos el HTML de encabezado de página
include_once "layout_head.php";

echo "<div class='col-sm-6 col-md-4 col-md-offset-4'>";

// obtenemos el valor de 'acción' en el parámetro url para mostrar los mensajes de solicitud correspondientes
$action = isset($_GET['action']) ? $_GET['action'] : "";

// le decimos al usuario que aún no ha iniciado sesión
if ($action == 'not_yet_logged_in') {
    echo "<div class='alert alert-danger margin-top-40' role='alert'>Por favor inicie sesión.</div>";
}

// se le dice al usuario que inicie sesión
else if ($action == 'please_login') {
    echo "<div class='alert alert-info'>
  <strong>Por favor inicie sesión.</strong>
</div>";
}

// se le indica al usuario que el correo electrónico está verificado
else if ($action == 'email_verified') {
    echo "<div class='alert alert-success'>
  <strong>Tu correo electrónico está verificado.</strong>
</div>";
}

// se le dice al usuario que su acceso esta denegado
if ($access_denied) {
    echo "<div class='alert alert-danger margin-top-40' role='alert'>
  Access Denied.<br /><br />
  Su nombre de usuario o contraseña pueden ser incorrectos
</div>";
}

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
