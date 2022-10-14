<?php

session_start();

  $codCli = $_SESSION['CodCliente'];
  $codPeli = $_SESSION['CodPelicula'];
  $codAlqui = $_SESSION['CodAlquiler'];
/*
$codCli = 5;
$codPeli = 17;
$codAlqui = 1;
*/
include 'Conexion_BD.php';

$queryCodFactura = "SELECT CodFactura "
        . "FROM alquileres "
        . "WHERE CodPelicula = " . $codPeli . " AND CodCliente = " . $codCli . " AND CodAlquiler = " . $codAlqui;
$res_validFactura = mysqli_query($conexion, $queryCodFactura) or die(mysqli_error($conexion));

$codigoFactura = mysqli_fetch_array($res_validFactura)[0];

$querydatos = "SELECT precioTotal, fechafactura "
        . "FROM facturas "
        . "WHERE CodFactura = " . $codigoFactura;
$res_validDatos = mysqli_query($conexion, $querydatos) or die(mysqli_error($conexion));
$result = mysqli_fetch_array($res_validDatos);
print("Codigo de la Factura: " . $codigoFactura . "");
print("<br>");
print("Precio de la Factura: " . $result['precioTotal'] . "");
print("<br>");
print("Fecha de la Factura: " . $result['fechafactura'] . "");
print("<br>");
print("<a href='Menu_Cliente.html'>Volver al Menu</a>");

