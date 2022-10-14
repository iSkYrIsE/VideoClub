<?php

session_start();
include 'Conexion_BD.php';
$codPeli = $_SESSION['codPeli'];
$email = $_SESSION['email'];

$query = "SELECT CodCliente "
        . "FROM Clientes "
        . "WHERE Email = '" . $email . "'";

$res_select = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
$codCli = mysqli_fetch_array($res_select);

$query_peli = "SELECT Precio, CodOferta "
        . "FROM peliculas "
        . "WHERE CodPelicula = " . $codPeli;
$res_select_peli = mysqli_query($conexion, $query_peli) or die(mysqli_error($conexion));
$result = mysqli_fetch_array($res_select_peli);

if ($result['CodOferta'] == null) {
    $precioFinal = $result['Precio'];
} else {
    $query_oferta = "SELECT Descuento "
            . "FROM ofertas "
            . "WHERE CodOferta = " . $result['CodOferta']
            . " AND FechaIni <= CURDATE()"
            . " AND FechaFin >= CURDATE()";
    $res_select_oferta = mysqli_query($conexion, $query_oferta) or die(mysqli_error($conexion));
    $result_oferta = mysqli_fetch_array($res_select_oferta);
    $precioFinal = $result['Precio'] -(($result['Precio']*$result_oferta['Descuento'])/100);
}

$query_insert_factura = "INSERT INTO facturas (PrecioTotal, FechaFactura) "
        . "VALUES (" .$precioFinal.", CURDATE())";
mysqli_query($conexion, $query_insert_factura) or die(mysqli_error($conexion));
$codFactura = mysqli_insert_id($conexion);

$query_insert_alquiler = "INSERT INTO alquileres (CodCliente, CodPelicula, CodFactura, FechaFinAlquiler) "
        . "VALUES (" . $codCli[0] . ", " . $codPeli .", ".$codFactura .", ADDDATE(CURDATE(), INTERVAL 7 DAY))";
mysqli_query($conexion, $query_insert_alquiler) or die(mysqli_error($conexion));
$codAlq = mysqli_insert_id($conexion);

$_SESSION['CodPelicula'] = $codPeli;
$_SESSION['CodCliente'] = $codCli[0];
$_SESSION['CodAlquiler'] = $codAlq;

header("location:Visualizar_Factura.php");
?>
