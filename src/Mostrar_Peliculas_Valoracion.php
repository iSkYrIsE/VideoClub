<?php

include 'Conexion_BD.php';

$numero_estrellas = $_POST["numeros"];


$query = "SELECT CodPelicula, Titulo "
        . "FROM peliculas "
        . "ORDER BY Titulo";

$res_pel = mysqli_query($conexion, $query) or die(mysqli_error($conexion));

if (mysqli_num_rows($res_pel) != 0) {
    while ($reg_pel = mysqli_fetch_array($res_pel)) {

        $CodPelicula = $reg_pel['CodPelicula'];
        $Titulo = $reg_pel['Titulo'];

        $suma = 0;
        $i = 0;
        $query2 = "SELECT Puntuacion FROM valoraciones "
                . "WHERE CodPelicula = " . $CodPelicula;

        $res_val = mysqli_query($conexion, $query2) or die(mysqli_error($conexion));

        if (mysqli_num_rows($res_val) != 0) {
            while ($reg_val = mysqli_fetch_array($res_val)) {

                $suma += $reg_val['Puntuacion'];
                $i++;
            }

            $media = $suma / $i;
            if ($media >= $numero_estrellas) {
                print("<p>Titulo: " . $Titulo . "    Valoración: " . $media . "</p>");
            }
        }
    }
}
print("<a href='Menu_Gestor.html'>Volver al Menú</a>");
?>