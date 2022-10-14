<?php
$Descuento = $_POST["Descuento"];
$DescripcionDescuento = $_POST["DescripcionDescuento"];
$FechaIni = $_POST["FechaIni"];
$FechaFin = $_POST["FechaFin"];
$nombreDescuento = $_POST["NombreDescuento"];

include 'Conexion_BD.php';

function validar_datos(&$Descuento, &$nombreDescuento, &$DescripcionDescuento, &$FechaIni, &$FechaFin) {

    $error = "";
    $validado = true;


    if (($Descuento == "") || ($Descuento >= 100 && $Descuento <= 0)) {
        $Descuento = "";
        $error = $error . " / Valor incorrecto";
        $validado = false;
    }
    if ($nombreDescuento == "") {
        $nombreDescuento = "";
        $error = $error . " / Nombre vacio";
        $validado = false;
    }
    if ($DescripcionDescuento == "") {
        $DescripcionDescuento = "";
        $error = $error . " / descripcion vacia o incorrecta";
        $validado = false;
    }
    if ($FechaIni == "") {
        $FechaIni = "";
        $error = $error . " / fecha inicio incorrecta";
        $validado = false;
    }
    if ($FechaFin == "") {
        $FechaFin = "";
        $error = $error . " / fecha fin incorrecta";
        $validado = false;
    }
    if ($FechaFin < $FechaIni) {
        $FechaIni = "";
        $FechaFin = "";
        $error = $error . " / La fecha de fin de la oferta no puede ser anterior a la fecha de inicio.";
        $validado = false;
    }
    
    if (date("Y/m/d") > strtotime($FechaFin)) {
        $FechaFin = "";
        $error = $error . " / La fecha de fin de la oferta no puede ser anterior al día de hoy";
        $validado = false;
    }
    echo($error);
    return $validado;
}

function pintar_formulario_alta_descuentos($Descuento, $nombreDescuento, $DescripcionDescuento, $FechaIni, $FechaFin) {

    $formulario1 = <<<FORMULARIO1
<form action="validar_descuento.php" method="post" name="formulario_alta_descuento">
        <p>DATOS DEL NUEVO DESCUENTO </p>
        <div align="left">
        <p>
            Descuento:
            <input name="Descuento" type="text"maxlength="3" value="$Descuento">
        </p>

        <p>Nombre del descuento: 
        <input name="NombreDescuento" type="text" value="$nombreDescuento">
        </p>
        <p>Descripcion del descuento: 
            <br>
            <textarea name="DescripcionDescuento" cols="30" rows="10">$DescripcionDescuento</textarea> 
        </p>

        <p>
            Fecha Inicio: 
            <input type="date" name="FechaIni" value="$FechaIni">
        </p>
            
        <p>
            Fecha Fin: 
            <input type="date" name="FechaFin" value="$FechaFin">
        </p>

        <p>
            <input type="submit" name="Submit" value="Guardar">
        </p>
        </div>
    </form>
FORMULARIO1;
    print $formulario1;
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
        if (!validar_datos($Descuento, $nombreDescuento, $DescripcionDescuento, $FechaIni, $FechaFin)) {
            pintar_formulario_alta_descuentos($Descuento, $nombreDescuento, $DescripcionDescuento, $FechaIni, $FechaFin);
        } else {
            if (mysqli_error($conexion)) {
                echo ('Error conexión');
                exit();
            } else {
                $query = "INSERT INTO ofertas "
                        . "(Descuento, NombreOferta, DescripcionDescuento, FechaIni, FechaFin) "
                        . "VALUES ('$Descuento', '$nombreDescuento', '$DescripcionDescuento', '$FechaIni', '$FechaFin')";
                $res_oferta = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
                if ($res_oferta) {
                    echo ('Oferta insertada');
                } else {
                    echo ('Problemas de Inserción');
                }
            }
        }
        ?>
        <br>
        <a href="Menu_Gestor.html">Volver al Menú</a>
    </body>
</html>


