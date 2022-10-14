<?php
session_start();

if (empty($_POST)) {
    $pwd = "";
    $email = "";
} else {
    $pwd = $_POST["password"];
    $email = $_POST["email"];
}

function validar(&$pwd, &$email, &$error) {
    $ok = true;
    if ($pwd == "") {
        $pwd = "";
        $error = $error . " / Contraseña vacia";
        $ok = false;
    }
    if (($email == "") || (!preg_match("/[[:alpha:]][[:alnum:]]*@[[:alpha:]]+\.[[:alpha:]]+/", $email))) {
        $email = "";
        $error = $error . " / email incorrecto";
        $ok = false;
    }
    if ($error == "") {
        $ok = true;
    }

    return $ok;
}

function pintar_formulario($pwd, $email) {
    $formulario = <<<FORMULARIO
<form action="Validar_Cliente.php" method="post" name="form_datos" enctype="multipart/form-data">    
    <div>
        <p>INTRODUCIR DATOS PERSONALES</p>
 
        <div align="left">  
            <p>
                Email:
                <input type="text" name="email" value="$email">
            </p>
            <p>
                Contraseña:
                <input type="password" name="password" value="$pwd">
            </p>
            <p>
                <input type="submit" name="Enviar" value="Enviar">
            </p>
        </div>
            <a href="Registrar_Cliente.php">Registrarse</a>
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
            pintar_formulario($pwd, $email);
        } else {
            $error = "";
            if (!validar($pwd, $email, $error)) {
                print("Errores: " . $error);
                pintar_formulario($pwd, $email);
            } else {
                $_SESSION["password"] = $pwd;
                $_SESSION["email"] = $email;

                header("location:Procesar_Datos_Validar_Cliente.php");
            }
        }
        ?>
    </body>
</html>