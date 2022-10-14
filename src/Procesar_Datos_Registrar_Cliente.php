<?php
session_start();
$nombre = $_SESSION['nombre'];
$email = $_SESSION['email'];
$pwd = $_SESSION['password'];
$cuenta = $_SESSION['cuenta'];

include 'Conexion_BD.php';

$query = "INSERT INTO clientes 
            (Nombre, Email, Clave, CuentaBancaria) 
        VALUES ('$nombre', '$email', '$pwd', '$cuenta')";

$res_usuario = mysqli_query($conexion, $query) or die(mysqli_error($conexion));

if ($res_usuario) {
    $codCli = mysqli_insert_id($conexion);
    echo ('Cliente insertado');
    $_SESSION['CodCliente'] = $codCli;
    header("location:Menu_Cliente.html");
} else {
    echo ('Problemas de Inserción');
}

?>