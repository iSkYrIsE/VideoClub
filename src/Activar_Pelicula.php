<?php

session_start();

$pel = $_SESSION['pel'];

include 'Conexion_BD.php';

$query = "UPDATE peliculas "
        . "SET DesactivarPelicula = 0 "
        . "WHERE Titulo = '" . $pel . "'";
mysqli_query($conexion, $query);
$res = mysqli_query($conexion, $query);
if ($res) {
    echo "pelicula activada con éxito";
} else {
    echo "error al activar pelicula ";
}
print("<br>");
print("<a href='Menu_Gestor.html'>Volver al Menu</a>");