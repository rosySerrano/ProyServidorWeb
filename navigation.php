<!--Obtenemos el nombre de la pagina-->
<?php
$php_Self = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL);
$urlPage = explode('/', $php_Self);
$namePage = array_pop($urlPage);
?>

<!-- La barra de navegación presenta las opciones de Inicio, Iniciar sesión y Registro -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">

                <!--Presenta la opción "Inicio". Solo si la pagina actual es la pagina de inicio se presenta activa esta opción-->
                <li <?php echo $namePage == $page_inicio ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>">Inicio </a>
                </li>
            </ul>

            <?php
            // comprueba si los usuarios / clientes iniciaron sesión
// si el usuario inició sesión, muestre las opciones "Editar perfil" y "Cerrar sesión"
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && trim($_SESSION['access_level']) == 'Lector') {
                

                ?>
                <ul class="nav navbar-nav navbar-right">                   
                    <li <?php echo $namePage == $page_login ? "class='active'" : ""; ?>>
                        <a href="<?php echo $home_url . $page_logout; ?>">
                            <span class="glyphicon glyphicon-log-out"></span> Cerrar sesión
                        </a>
                    </li>
                </ul>
                <?php
            }

            // si el usuario no inició sesión, muestre las opciones de "inicio de sesión" y "registro"
            else {
                ?>
                <ul class="nav navbar-nav navbar-right">

                    <!--Presenta la opción "Login". Solo si la pagina actual es la pagina de inicio de sesión se presenta activa esta opción-->
                    <li <?php echo $namePage == $page_login ? "class='active'" : ""; ?>>
                        <a href="<?php echo $home_url . $page_login; ?>">
                            <span class="glyphicon glyphicon-log-in"></span> Iniciar sesión
                        </a>
                    </li>

                    <!--Presenta la opción "Registro". Solo si la pagina actual es la pagina de registro se presenta activa esta opción-->
                    <li <?php echo $namePage == $page_registro ? "class='active'" : ""; ?>>
                        <a href="<?php echo $home_url . $page_registro; ?>">
                            <span class="glyphicon glyphicon-check"></span> Registro
                        </a>
                    </li>
                </ul>
                <?php
            }
            ?>

        </div><!--/.nav-collapse -->

    </div><!-- /container-fluid -->
</div><!-- /navbar -->

