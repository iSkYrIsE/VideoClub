<?php
session_start();

if (empty($_POST)) {
    $nom = "";
    $email = "";
    $pwd = "";
    $pwd2 = "";
    $cuenta = "";
} else {
    $nom = $_POST["nombre"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $pwd2 = $_POST["password2"];
    $cuenta = $_POST["cuenta"];
}

function validar(&$nom, &$email, &$pwd, &$pwd2, &$cuenta, &$error) {
    $ok = true;

    if ($nom == "") {
        $nom = "";
        $error = $error . " / Nombre vacio";
        $ok = false;
    }
    if (($email == "") || (!preg_match("/[[:alpha:]][[:alnum:]]*@[[:alpha:]]+\.[[:alpha:]]+/", $email))) {
        $email = "";
        $error = $error . " / Email incorrecto";
        $ok = false;
    }
    if(($pwd == "")||($pwd2 == "")||($pwd != $pwd2)){
        $pwd = "";
        $pwd2 = "";
        $error = $error . " / Error introduccion contraseña";
        $ok = false;
    }
    if($cuenta == "" || (!preg_match("^[A-Z]{2}[0-9]{22}^", $cuenta))){
        $cuenta = "";
        $error = $error. " / Cuenta incorrecta";
        $ok = false;
    }
    if ($error == "") {
        $ok = true;
    }

    return $ok;
}

function pintar_formulario($nom, $email, $pwd, $pwd2, $cuenta) {
    $formulario = <<<FORMULARIO
<form action="Registrar_Cliente.php" method="post" name="form_datos" enctype="multipart/form-data">    
    <div>
        <p>INTRODUCIR DATOS PERSONALES</p>
 
        <div align="left">  
            <p>
                Nombre: 
                <input name="nombre" type="text" size="20" maxlength="20" value="$nom">
            </p>
            <p>
                Email:
                <input type="email" name="email" value="$email">
            </p>
            <p>
                Contraseña: 
                <input name="password" type="password"  value="$pwd">
            </p>
            <p>
                Confirmar Contraseña: 
                <input name="password2" type="password"  value="$pwd2">
            </p>
            <p>
                Cuenta Bancaria: 
                <input name="cuenta" type="text"  value="$cuenta">
            </p>
            <p>
                <input type="submit" name="Enviar" value="Enviar">
            </p>
        </div>
    </div>
FORMULARIO;
    print $formulario;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="estiloformulario.css" />

    </head>
    <body>
        <?php
        if (empty($_POST)) {
            pintar_formulario($nom, $email, $pwd, $pwd2, $cuenta);
        } else {
            $error = "";
            if (!validar($nom, $email, $pwd, $pwd2, $cuenta, $error)) {
                print("Errores: " . $error);
                pintar_formulario($nom, $email, $pwd, $pwd2, $cuenta);
            } else {
                $_SESSION["nombre"] = $nom;
                $_SESSION["email"] = $email;
                $_SESSION["password"] = $pwd;
                $_SESSION["cuenta"] = $cuenta;

                header("location:Procesar_Datos_Registrar_Cliente.php");
            }
        }
        ?>
    </body>
</html>