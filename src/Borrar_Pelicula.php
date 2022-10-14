<?php

session_start();

$titulo = $_SESSION['pelicula'];
include 'Conexion_BD.php';

$query_del = "DELETE FROM peliculas "
        . "WHERE Titulo = '" . $titulo . "'";
$res_del = mysqli_query($conexion, $query_del);
if ($res_del) {
    echo "Borrado con exito";
    print("<br>");
    print("<a href='Menu_Gestor.html'>Volver al Menu</a>");
} else {
    echo "No se ha podido borrar la pelicula: " . $titulo . " porque está alquilada";
    print("<br>");
    $query = "UPDATE peliculas "
            . "SET DesactivarPelicula = 1 "
            . "WHERE Titulo = '" . $titulo . "'";
    mysqli_query($conexion, $query);
    $res = mysqli_query($conexion, $query);
    if ($res) {
        echo "La película se ha desactivado";
    } else {
        echo "No se ha podido desactivar la película";
    }
    print("<br>");
    print("<a href='Menu_Gestor.html'>Volver al Menu</a>");
}



