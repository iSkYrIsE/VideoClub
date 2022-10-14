<?php

session_start();

$codPeli = $_REQUEST['codPeli'];

include 'Conexion_BD.php';

$query = "SELECT Titulo, Genero "
        . "FROM peliculas "
        . "WHERE CodPelicula=". $codPeli .";";
$res_valid = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
if(mysqli_num_rows($res_valid) != 0){
    while($result = mysqli_fetch_array($res_valid)){
        print("Titulo: ". $result['Titulo'] .", Genero: ". $result['Genero']);
        print("<br>");
        $_SESSION['CodPeli'] = $codPeli;
        print("<a href='Valorar_Pelicula.php'>Valorar</a>");
    }
}