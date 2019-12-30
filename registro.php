<?php

// configuración central
include_once "config/core.php";

// establecemos el título de la página
$page_title = "Registro";

// se incluye el verificador de inicio de sesión
$require_login = false;
include_once "login_checker.php";

// incluimos el HTML de encabezado de página
include_once "layout_head.php";

//Si se selecciono la opción Registrar 
if ($_POST) {

    // Variables para cada campo del formulario de registro
    $nombre = filter_input(INPUT_POST, "name_control");
    $userName = filter_input(INPUT_POST, "userName_control");
    $password = filter_input(INPUT_POST, "password_control");
    $email = filter_input(INPUT_POST, "email_control");
    $rol = "lector";

    //Generamos una cadena con los datos del formulario seperados por coma y al final de cada registro un punto y coma
    $dato = $nombre . "," . $userName . "," . $password . "," . $email .  "," . $rol . ";";

    //Abrimos el archivo de registros para guardar el registro
    $fileUsuarios = fopen($path, "a");
    $registro = fwrite($fileUsuarios, $dato);
    fclose($fileUsuarios);

    //Si no se realizo el registro se muestra un mensaje de error, de lo contrario se redirecciona a la página de inicio
    if ($registro === false) {
        echo "<br/><div class='alert alert-danger' role='alert'>El registro no se realizo. Trate de nuevo por favor.</div>";
    } else {
        echo "<br/><div class='alert alert-success'>";
        echo "Registro exitoso. <a href='{$home_url}{$page_inicio}'>Inicia sesión</a>.";
        echo "</div>";

        $nombre = "";
        $userName = "";
        $password = "";
        $email = "";
    }
}
echo
"
<div class='col-md-12'>
    <form  class='form-horizontal' action='./registro.php' method='post' id='registro'>
                <div class='form-group'>
                    <label class='control-label col-sm-2' for='name_control'>Nombre Completo: </label>
                    <div class='col-sm-5'>
                        <input type='text' name='name_control' class='form-control' placeholder='Ingresa nombre completo' maxlength='50' autofocus required/>
                    </div>
                </div>    
                <div class='form-group'>
                    <label class='control-label col-sm-2' for='userName_control'> Nombre usuario: </label>
                    <div class='col-sm-5'>
                        <input type='text' name='userName_control'  class='form-control' placeholder='Ingresa nombre de usuario' maxlength='15' required />
                    </div>
                </div> 
                <div class='form-group'>
                    <label class='control-label col-sm-2' for='password_control'> Contraseña: </label>
                    <div class='col-sm-5'>
                        <input type='text' pattern='(?=.*\d)(?=.*[a-z]).{8}' name='password_control'  class='form-control' placeholder='Ingresa contraseña'
                               maxlength='8' title='Debe contener al menos un numero, una letra y la longitud de 8 caracteres' required/>
                    </div>
                </div>
                <div class='form-group'>
                    <label class='control-label col-sm-2' for='email_control'> Correo Electrónico: </label>
                    <div class='col-sm-5'>
                        <input type='email' name='email_control'  class='form-control' placeholder='Ingresa correo electrónico' required />
                    </div>
                </div>
                <div class='form-group'>
                    <div class='col-sm-offset-2 col-sm-5'>
                        <button  type='submit' class='btn btn-default'> Registrar </button>
                    </div>
                </div>
            </form>
</div>";
// pie de página códigos HTML y JavaScript
include_once "layout_foot.php";
?>