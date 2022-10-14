<?php
session_start();
$codPeli = $_SESSION['CodPeli'];
if (empty($_POST)) {
    $valoracion = "";
} else {
    $valoracion = $_POST['valoracion'];
}
include 'Conexion_BD.php';

function pintar_formulario(){
    $formulario = <<<FORMULARIO
<form action="./Valorar_Pelicula.php" method="post" name="form_datos" enctype="multipart/form-data">    
    <div>
        <div>  
            <p>
                Valoracion:
            </p>
                <input type="radio" id="1" name="valoracion" value="1" style="height: 1em;">1
                <input type="radio" id="2" name="valoracion" value="2" style="height: 1em;">2
                <input type="radio" id="3" name="valoracion" value="3" style="height: 1em;">3
                <input type="radio" id="4" name="valoracion" value="4" style="height: 1em;">4
                <input type="radio" id="5" name="valoracion" value="5" style="height: 1em;">5
            
            <p>
                <input type="submit" name="Enviar" value="Enviar">
            </p>
        </div>
    </div>
FORMULARIO;
    print $formulario;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="estiloformulario.css" />

    </head>
    <body>
        <?php
        pintar_formulario();
        if (!empty($valoracion)) {
            $query = "INSERT INTO valoraciones (CodPelicula, Puntuacion) "
                    . "VALUES ('" . $codPeli . "', '" . $valoracion . "')";
            $res_val = mysqli_query($conexion, $query);
            if ($res_val) {
                header("location:Menu_Cliente.html");
            } else {
                echo ('Problemas de Inserción');
            }
        }
        ?>
        <a href="Menu_Cliente.html">Volver al menu</a>
    </body>
</html>
