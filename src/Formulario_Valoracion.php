<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

function conectar_bd() {
    $conex = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
    mysqli_select_db($conex, "otri") or die(mysqli_error());
    return $conex;
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="estiloformulario.css" />
        <title>Formulario insertar datos proyecto</title>
    </head>
    <form action="./Mostrar_Peliculas_Valoracion.php" method="post" name="formulario_insertar_proyecto">

        <p>MOSTRAR LAS PELICULAS QUE TENGAN MAS DE N ESTRELLAS</p>





        <p>ELIGE EL NUMERO DE ESTRELLAS

            <select name='numeros' style="width:80%; font-size:30px; padding: 7px; max-width: 330px;
                    margin: auto; border-radius: 28px;
                    text-shadow: 3px 2px 1px #9daef5; 
                    box-shadow: 6px 5px 24px #black;
                    font-family: Arial; 
                    color: #black; 
                    font-size: 27px;">
                <option value='1'>1
                <option value='2'>2
                <option value='3'>3
                <option value='4'>4
            </select>

        </p>



        <p>
            <input type="submit" name="Submit" value="Calcular">
        </p>
        <a href="Menu_Gestor.html">Volver al Menú</a>

    </form>
</body>
</html>