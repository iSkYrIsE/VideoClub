<?php

include 'Conexion_BD.php';

$query = "SELECT CodPelicula, Titulo, Precio "
        . "FROM Peliculas "
        . "WHERE DesactivarPelicula = 0 "
        . "ORDER BY Titulo";


$res_pelis = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
if (mysqli_num_rows($res_pelis) != 0) {
    while ($result = mysqli_fetch_array($res_pelis)) {
        $suma = 0;
        $i = 0;
        $query2 = "SELECT Puntuacion FROM valoraciones "
                . "WHERE CodPelicula = " . $result['CodPelicula'];

        $res_val = mysqli_query($conexion, $query2) or die(mysqli_error($conexion));

        if (mysqli_num_rows($res_val) != 0) {
            while ($reg_val = mysqli_fetch_array($res_val)) {

                $suma += $reg_val['Puntuacion'];
                $i++;
            }
            $media = bcdiv($suma, $i, 1);
            print("<a href='Consultar_Pelicula_Seleccionada.php?codPeli=" . $result['CodPelicula'] . "'>" . $result['Titulo'] . "</a><p> " . $result['Precio'] . "€ Valoración: " . $media . "</p><br>");
        } else {
            print("<a href='Consultar_Pelicula_Seleccionada.php?codPeli=" . $result['CodPelicula'] . "'>" . $result['Titulo'] . "</a><p> " . $result['Precio'] . "€ Valoración: No valorado aún</p><br>");
        }
    }
}
?>