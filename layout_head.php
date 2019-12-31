<!--//con la declaracion "PHP include_once" podemos optimizar el uso del encabezado apra todas las paginas php-->

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- establecemos el título de la página a traves de un parametro si no se encuentra defino se utiliza el texto -->
        <title><?php echo isset($page_title) ? strip_tags($page_title) : "Descarga Libros Online"; ?></title>

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen" />

    </head>
    <body>
        <div class="page-header">
             <h1> <img src="./recursos/libros.jpg" class="img-rounded"  width="50" height="50"> Libros Al Bolsillo</h1>
        </div>
        <!-- incluimos la barra de navegacion -->
        <?php include_once 'navigation.php'; ?>

        <!-- contenedor -->
        <div class="container">

            <?php
            // si el título de la página dado es 'Iniciar sesión', no muestre el título
            if ($page_title == "Registro") {
                ?>
                <div class='col-md-12'>
                    <div class="page-header">
                        <h1><?php echo isset($page_title) ? $page_title : ""; ?></h1>
                    </div>
                </div>
                <?php
            }
            ?>
