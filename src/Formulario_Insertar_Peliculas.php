<?php
session_start();
if (empty($_POST)) {
    $titulo = "";
    $genero = "";
    $anoProduc = "";
    $anoEstreno = "";
    $precio = "";
    $descSelec = "";
} else {
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $anoProduc = $_POST['anoProduc'];
    $anoEstreno = $_POST['anoEstreno'];
    $precio = $_POST['precio'];
    $descSelec = $_POST['descuento'];
}

function validar(&$titulo, &$genero, &$anoProduc, &$anoEstreno, &$precio, &$error) {
    $ok = true;
    if (($titulo == "")) {
        $titulo = "";
        $error = $error . " / titulo incorrecto";
        $ok = false;
    }
    if ($genero == "") {
        $genero = "";
        $error = $error . " / genero incorrecto";
        $ok = false;
    }
    if (($anoProduc == "") || ($anoProduc >= date("Y/m/d"))) {
        $anoProduc = "";
        $error = $error . " / Año de produccion incorrecto";
        $ok = false;
    }
    if (($anoEstreno == "") || (strtotime($anoEstreno) >= date("Y/m/d")) || !($anoEstreno >= $anoProduc)) {
        $anoEstreno = "";
        $error = $error . " / Año de estreno incorrecto";
        $ok = false;
    }
    if (($precio == "") || !($precio > 0)) {
        $precio = "";
        $error = $error . " / Precio incorrecto";
        $ok = false;
    }
    if ($error == "") {
        $ok = true;
    }

    return $ok;
}

function pintar_formulario($titulo, $genero, $anoProduc, $anoEstreno, $precio, $descSelec) {
    $conexion = mysqli_connect('localhost', 'root', '') or die(mysqli_error($conexion));
    mysqli_select_db($conexion, "VideoClub") or die(mysqli_error($conexion));
    $formulario1 = <<<FORMULARIO1
<form action="Formulario_Insertar_Peliculas.php" method="post" name="form_datos" enctype="multipart/form-data">    
    <div>
        <p>INTRODUCIR DATOS PELICULA</p> 
    <div align="left">  
        <p>
            Titulo:
            <input name="titulo" type="text" maxlength="24" value="$titulo">
        </p>
    </div>
    <div align="left">  
        <p>
            Genero: 
            <input name="genero" type="text" value="$genero">
        </p>
    </div>
    <div align="left">  
        <p>
            Año produccion:
            <input name="anoProduc" type="date" value="$anoProduc">
        </p>
    </div>
    <div>  
        <p>
            Año estreno:
            <input name="anoEstreno" type="date" value="$anoEstreno">
        </p>
    </div>
    <div>  
        <p>
            Precio:
            <input name="precio" type="text" maxlength="24" value="$precio">
        </p>
    </div>
    <div>
            <p>
            Descuento: 
            <select name='descuento' style=" width:80%; font-size:30px; padding: 7px; max-width: 330px; margin: auto; border-radius: 28px;
    text-shadow: 3px 2px 1px #9daef5; 
    box-shadow: 6px 5px 24px #black;
    font-family: Arial; 
    color: #black; 
    font-size: 27px;">
            <option value='NULL'> Sin descuento
FORMULARIO1;
    print $formulario1;
    
    $query = "SELECT CodOferta, NombreOferta, Descuento "
            . "FROM ofertas "
            . "WHERE FechaFin >= CURDATE()";
    $result = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
    if (mysqli_num_rows($result) != 0) {
        while ($res_desc = mysqli_fetch_array($result)) {
            $descuento = $res_desc["CodOferta"];
            $nombre = $res_desc["NombreOferta"];
            $cantidad = $res_desc["Descuento"];
            if ($descSelec == $descuento) {
                echo ("<option value='$descuento' selected>$nombre $cantidad%");
            } else {
                echo("<option value='$descuento'>$nombre $cantidad%");
            }
        }
    }
    

    $formulario = <<<FORMULARIO
            </select>
        </p>     
        <p>
            <input type="submit" name="Enviar" value="Enviar">
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
        $conexion = mysqli_connect('localhost', 'root', '') or die(mysqli_error($conexion));
        mysqli_select_db($conexion, "VideoClub") or die(mysqli_error($conexion));
        if (empty($_POST)) {
            pintar_formulario($titulo, $genero, $anoProduc, $anoEstreno, $precio, $descSelec);
        } else {
            $error = "";
            if (!validar($titulo, $genero, $anoProduc, $anoEstreno, $precio, $error)) {
                print("Errores: " . $error);
                pintar_formulario($titulo, $genero, $anoProduc, $anoEstreno, $precio, $descSelec);
            } else {
                if ($descSelec == "NULL") {
                    $query = "INSERT INTO Peliculas "
                            . "(Titulo, Genero, AnnoProduccion, AnnoEstreno, Precio, CodOferta, DesactivarPelicula) "
                            . "VALUES ('$titulo', '$genero', '$anoProduc', '$anoEstreno', '$precio', NULL, 0)";
                } else {
                    $query = "INSERT INTO Peliculas "
                            . "(Titulo, Genero, AnnoProduccion, AnnoEstreno, Precio, CodOferta, DesactivarPelicula) "
                            . "VALUES ('$titulo', '$genero', '$anoProduc', '$anoEstreno', '$precio', '$descSelec', 0)";
                }
                $res_peli = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
                if ($res_peli) {
                    echo ('Pelicula insertada');
                } else {
                    echo ('Problemas de Inserción');
                }
                print("<br>");
                print("<a href='Menu_Gestor.html'>Volver al Menú</a>");
            }
        }
        ?>

    </body>
</html>