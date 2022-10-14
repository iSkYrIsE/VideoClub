<?php

$conexion = mysqli_connect('localhost', 'root', '') or die (mysqli_error($conexion));
mysqli_select_db($conexion, "VideoClub") or die (mysqli_error($conexion));
?>
