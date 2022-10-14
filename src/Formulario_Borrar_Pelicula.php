<?php
session_start();
if (empty($_POST)) {
    $pelicula = "";
} else {
    $pelicula = $_POST['pelicula'];
}

function validar(&$pelicula, &$error) {
    $ok = true;
    
    if ($pelicula == "") {
        $pelicula = "";
        $error = $error . " / pelicula incorrecta";
        $ok = false;
    }
    if ($error == "") {
        $ok = true;
    }
    return $ok;
}

function pintar_formulario($pelicula) {
    $formulario = <<<FORMULARIO
<form action="./Formulario_Borrar_Pelicula.php" method="post" name="form_datos" enctype="multipart/form-data">    
    <div>
        <p>INTRODUCIR PELICULA A BORRAR</p> 
    <div align="left">  
        <p>
            Pelicula:
            <input name="pelicula" type="text" maxlength="24" value="$pelicula">
        </p>
    </div>
    <div float:left>
        <p>
            <input type="submit" name="Borrar" value="Borrar">
	</p>
    </div>
            <a href="Menu_Gestor.html">Volver al Menú</a>
            
</form>
FORMULARIO;

    
    print $formulario;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="estiloformulario.css" />
    </head>
    <body>
        <?php

        if (empty($_POST)) {
            pintar_formulario($pelicula);
        } else {
            $error = "";
            if (!validar($pelicula, $error)) {
                print("Errores: " . $error);
                pintar_formulario($pelicula);
            } else {
 
                $_SESSION["pelicula"] = $pelicula;
                header("location: http://localhost/VideoClub/Borrar_Pelicula.php");
            }
        }
        ?>
    </body>
</html>

