<?php

session_start();
$pwd = $_SESSION['password'];
$email = $_SESSION['email'];

if (($email != "gestor@gmail.com") || ($pwd != "qwer")) {
    echo "usuario o clave incorrectos";
    header("location:Validar_Gestor.php");
} else {
    header("location:Menu_Gestor.html");
}
?>