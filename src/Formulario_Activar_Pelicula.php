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
    $conexion = mysqli_connect('localhost', 'root', '') or die(mysqli_error($conexion));
    mysqli_select_db($conexion, "VideoClub") or die(mysqli_error($conexion));
    $formulario1 = <<<FORMULARIO1
<form action="./Formulario_Activar_Pelicula.php" method="post" name="form_datos" enctype="multipart/form-data">    
    <div>
        <p>INTRODUCIR PELICULA A ACTIVAR</p> 
    <div align="left">  
        <p>
            Película:
            <select name='pelicula' style=" width:80%; font-size:30px; padding: 7px; max-width: 330px; margin: auto; border-radius: 28px;
    text-shadow: 3px 2px 1px #9daef5; 
    box-shadow: 6px 5px 24px #black;
    font-family: Arial; 
    color: #black; 
    font-size: 27px;">
FORMULARIO1;
    print $formulario1;

    $query = "SELECT CodPelicula, Titulo "
            . "FROM peliculas "
            . "WHERE DesactivarPelicula = 1";
    $result = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
    if (mysqli_num_rows($result) != 0) {
        while ($res_pel = mysqli_fetch_array($result)) {
            $codPeli = $res_pel["CodPelicula"];
            $titulo = $res_pel["Titulo"];
            if ($pelicula == $titulo) {
                echo ("<option value='$codPeli' selected>$titulo");
            } else {
                echo("<option value='$codPeli'>$titulo");
            }
        }
    }


    $formulario = <<<FORMULARIO
            </select>
        </p>
    </div>
    <div float:left>
        <p>
            <input type="submit" name="Activar" value="Activar">
	</p>
    </div>
            </div>
</form>
            <a href='Menu_Gestor.html'>Volver al Menu</a>
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

                $_SESSION["pel"] = $pelicula;
                header("location: http://localhost/VideoClub/Activar_Pelicula.php");
            }
        }
        //print("<a href='Menu_Gestor.html'>Volver al Menu</a>");
        ?>
    </body>
</html>
