<?php

session_start();
$pwd = $_SESSION['password'];
$email = $_SESSION['email'];

include 'Conexion_BD.php';

$query = "SELECT CodCliente "
        . "FROM clientes "
        . "WHERE Email = '" . $email . "' AND Clave = '" . $pwd . "';";

$res_valid = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
if ((mysqli_num_rows($res_valid) == 0) || !$email || !$pwd) {
    echo "usuario o clave incorrectos";
    header("location: Validar_Cliente.php");
    
} else {
    $result = mysqli_fetch_array($res_valid);
    $_SESSION['CodCliente'] = $result['CodCliente'];
    header("location:Menu_Cliente.html");
}

?>