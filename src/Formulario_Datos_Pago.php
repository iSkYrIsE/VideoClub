<?php
session_start();
include 'Conexion_BD.php';
if (empty($_POST)) {
    $email = "";
    $pwd = "";
} else {
    $email = $_POST['email'];
    $pwd = $_POST['password'];
}

function validar(&$email, &$pwd, &$error) {
    $conexion = mysqli_connect('localhost', 'root', '') or die(mysqli_error($conexion));
    mysqli_select_db($conexion, "VideoClub") or die(mysqli_error($conexion));
    
    $query = "SELECT CodCliente FROM clientes "
            . "WHERE Email = '".$email."' "
            . "AND Clave = '".$pwd."'";
    
    $result = mysqli_query($conexion, $query);

    if ($result == false) {
        $email = "";
        $pwd = "";
        $error = $error . " / Email o Contraseña incorrecta";
        $ok = false;
    }
    $ok = true;
    if ($email == "") {
        $email = "";
        $error = $error . " / Email Vacio";
        $ok = false;
    }
    if ($pwd == "") {
        $pwd = "";
        $error = $error . " / Contraseña vacia";
        $ok = false;
    }
    
    

    if ($error == "") {
        $ok = true;
    }

    return $ok;
}

function pintar_formulario($email, $pwd) {
    $formulario = <<<FORMULARIO
<form action="Formulario_Datos_Pago.php" method="post" name="form_datos" enctype="multipart/form-data">    
    <div>
        <p>INTRODUCIR DATOS PAGO</p> 
    <div align="left">  
        <p>
            Email: 
            <input name="email" type="text" value="$email">
        </p>
    </div>
    <div float:left>
        <p>
           Contraseña: 
            <input name="password" type="password" value="$pwd"> 
        </p>
        <p>
            <input type="submit" name="Enviar" value="Enviar">
	</p>
    </div>

</form>
FORMULARIO;

    print $formulario;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="estiloformulario.css" />
    </head>
    <body>
        <?php
        if (empty($_POST)) {
            pintar_formulario($email, $pwd);
        } else {
            $error = "";
            if (!validar($email, $pwd, $error)) {
                print("Errores: " . $error);
                pintar_formulario($email, $pwd);
            } else {
                $query = "SELECT CuentaBancaria FROM clientes "
                        . "WHERE Email = '" . $email . "' "
                        . "AND Clave = '" . $pwd."'";
                $result = mysqli_query($conexion, $query);
                $cuenta = mysqli_fetch_array($result);
                $_SESSION['email'] = $email;
                $_SESSION['cuenta'] = $cuenta[0];
                        
                header("location: http://localhost/VideoClub/Confirmar_Datos_Introducidos_Pago.php");
            }
        }
        ?>
        <a href='Menu_Cliente.html'>Volver al Menu</a>
    </body>
</html>