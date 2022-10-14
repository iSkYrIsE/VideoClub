<?php
session_start();
$codCli = $_SESSION['CodCliente'];
include 'Conexion_BD.php';

$query = "SELECT CodPelicula, Titulo "
        . "FROM Peliculas "
        . "WHERE CodPelicula IN (SELECT CodPelicula FROM alquileres WHERE CodCliente = ". $codCli." AND FechaFinAlquiler > CURDATE()) "
        . "ORDER BY Titulo";
$res_pelis = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
if(mysqli_num_rows($res_pelis)!=0){
    while($result = mysqli_fetch_array($res_pelis)){
        printf("<a href='Consultar_BD_VideoClub_Pelicula.php?codPeli=". $result['CodPelicula'] ."'>". $result['Titulo'] ."</a><br>");
    }
}

$query_delete = "DELETE FROM alquileres "
        . "WHERE FechaFinAlquiler <= CURDATE()";
mysqli_query($conexion, $query_delete);

?>