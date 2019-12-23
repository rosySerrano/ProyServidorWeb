<html>
    <head>
        <meta charset="UTF-8">
        <title>Descarga Libros PDF</title>
    </head>
    <body>
        Guardar registro en archivo
        <?php
            //Ruta del archivo para registros
            $path = "./recursos/datosRegistro.txt";
        
            // Variables para cada campo del formulario de registro
            $nombre = filter_input(INPUT_POST, "name_control");
            $userName = filter_input(INPUT_POST, "userName_control");
            $password = filter_input(INPUT_POST, "password_control");
            $email = filter_input(INPUT_POST, "email_control"); 
            
            //Generamos una cadena con los datos del formulario seperados por coma y al final de cada registro un punto y coma
            $dato = $nombre.",".$userName.",".$password.",".$email.";";
            
            //Abrimos el archivo de registros para guardar el registro
            $fileUsuarios = fopen($path, "a");
            fwrite($fileUsuarios, $dato);
            fclose($fileUsuarios);
            
        ?>
    </body>
</html>