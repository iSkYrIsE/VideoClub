<?php
session_start();
$cuenta = $_SESSION['cuenta'];
$email = $_SESSION['email'];

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="estiloformulario.css" />
    </head>
    <body>
        <?php
        
        print($email);
        print("<br>");
        print($cuenta);
        print("<br>");
        
        ?>
        <div>Estan correctos tus datos?</div>
        
        <button onclick="location.href='http://localhost/VideoClub/Alquilar_Pelicula.php'">Si, son mis datos</button>
        
        <button onclick="location.href = 'http://localhost/VideoClub/Cambiar_Datos_Cliente.php'">No, quiero cambiar los datos</button>
        
        <button onclick="location.href = 'http://localhost/VideoClub/Menu_Cliente.html'">No, Volver al menú</button>
    </body>
</html>