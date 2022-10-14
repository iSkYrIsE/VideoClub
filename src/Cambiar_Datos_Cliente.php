<?php
session_start();

if (empty($_POST)) {
    $nom = "";
    $email = "";
    $pwd = "";
    $newpwd = "";
    $newpwd2 = "";
    $cuenta = "";
} else {
    $nom = $_POST["nombre"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $newpwd = $_POST["newpassword"];
    $newpwd2 = $_POST["newpassword2"];
    $cuenta = $_POST["cuenta"];
}

function validar(&$nom, &$email, $pwd, &$newpwd, &$newpwd2, &$cuenta) {
    $ok = true;

    $conexion = mysqli_connect('localhost', 'root', '') or die(mysqli_error($conexion));
    mysqli_select_db($conexion, "VideoClub") or die(mysqli_error($conexion));

    $codCli = $_SESSION["CodCliente"];

    $query = "SELECT Clave "
            . "FROM clientes "
            . "WHERE CodCliente = " . $codCli;
    $clave = mysqli_fetch_array(mysqli_query($conexion, $query));
    if ($clave[0] == $pwd) {

        if ($nom == "") {
            $nom = "";
        } else {
            $query = "UPDATE clientes "
                    . "SET Nombre ='" . $nom . "'"
                    . "WHERE CodCliente = '" . $codCli . "';";
            mysqli_query($conexion, $query);
        }

        if (($email == "") || (!preg_match("/[[:alpha:]][[:alnum:]]*@[[:alpha:]]+\.[[:alpha:]]+/", $email))) {
            $email = "";
        } else {
            $query = "UPDATE clientes "
                    . "SET Email ='" . $email . "'"
                    . "WHERE CodCliente = '" . $codCli . "';";
            mysqli_query($conexion, $query);
        }

        if (($newpwd == "") || ($newpwd2 == "") || ($newpwd != $newpwd2)) {
            $newpwd = "";
            $newpwd2 = "";
        } else {
            $query = "UPDATE clientes "
                    . "SET Clave ='" . $newpwd . "'"
                    . "WHERE CodCliente = '" . $codCli . "';";
            mysqli_query($conexion, $query);
        }

        if ($cuenta == "" || (!preg_match("^[A-Z]{2}[0-9]{22}", $cuenta))) {
            $cuenta = "";
        } else {
            $query = "UPDATE clientes "
                    . "SET CuentaBancaria ='" . $cuenta . "'"
                    . "WHERE CodCliente = '" . $codCli . "';";
            mysqli_query($conexion, $query);
        }
        print("Se han cambiado los datos rellenados correctamente");
    }else{
        print("La contraseña es incorrecta por lo que los datos no se cambiarán");
    }
    return $ok;
}

function pintar_formulario($nom, $email, $pwd, $newpwd, $newpwd2, $cuenta) {
    $formulario = <<<FORMULARIO
<form action="Cambiar_Datos_Cliente.php" method="post" name="form_datos" enctype="multipart/form-data">    
    <div>
        <p>INTRODUCIR NUEVOS DATOS PERSONALES</p>
            
            <p>
                Introducir contraseña (Campo obligatorio): 
            <br>
                <input name="password" type="password"  value="$pwd">
            </p>
            <p>Los campos en blanco no se cambiarán</p>
 
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
                Contraseña nueva: 
                <input name="newpassword" type="password"  value="$newpwd">
            </p>
            <p>
                Confirmar Contraseña nueva: 
                <input name="newpassword2" type="password"  value="$newpwd2">
            </p>
            <p>
                Cuenta Bancaria: 
                <input name="cuenta" type="text"  value="$cuenta">
            </p>
            <p>
                <input type="submit" name="Enviar" value="Enviar">
            </p>
            <a href='Menu_Cliente.html'>Volver al Menu</a>
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
            pintar_formulario($nom, $email, $pwd, $newpwd, $newpwd2, $cuenta);
        } else {
            validar($nom, $email, $pwd, $newpwd, $newpwd2, $cuenta);
            print("<br>");
            print("<a href='Menu_Cliente.html'>Volver al Menu</a>");
        }
        ?>
    </body>
</html>