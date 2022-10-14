<?php

session_start();

$codCli = $_SESSION['CodCliente'];
include 'Conexion_BD.php';

$query_Update_Alquileres = "UPDATE alquileres "
        . "SET CodCliente = 0 "
        . "WHERE CodCliente = '" . $codCli . "'";
mysqli_query($conexion, $query_Update_Alquileres);

$query = "DELETE FROM clientes "
        . "WHERE CodCliente= '" . $codCli . "'";

$res = mysqli_query($conexion, $query);
if ($res) {
    echo "Borrado con exito";
} else {
    echo "error al borrar la usuario ";
}

print("<a href='Menu_Opciones.html'>Volver al Menu</a>");



