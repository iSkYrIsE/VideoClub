<?php

session_start();

$codPeli = $_REQUEST['codPeli'];
$_SESSION['codPeli'] = $codPeli;
include 'Conexion_BD.php';

$query = "SELECT Titulo, Genero, Precio, CodOferta "
        . "FROM peliculas "
        . "WHERE CodPelicula=" . $codPeli . ";";
$res_valid = mysqli_query($conexion, $query) or die(mysqli_error($conexion));


if (mysqli_num_rows($res_valid) != 0) {
    while ($result = mysqli_fetch_array($res_valid)) {

        print("Titulo: " . $result['Titulo'] . ", Genero: " . $result['Genero'] . ", Precio: " . $result['Precio'] . "€");
        if ($result['CodOferta'] != NULL) {
            $query2 = "SELECT Descuento "
                    . "FROM ofertas "
                    . "WHERE CodOferta = '" . $result['CodOferta'] . "' "
                    . "AND FechaIni <= CURDATE() "
                    . "AND FechaFin >= CURDATE()";
            if(mysqli_fetch_array(mysqli_query($conexion, $query2))!=NULL){
                print(" Descuento: ".mysqli_fetch_array(mysqli_query($conexion, $query2))[0]."%");
            }
            
        }
        print("<br>");
        print("<a href='Formulario_Datos_Pago.php'>Alquilar</a>");
    }
}

