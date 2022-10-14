<?php ?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="estiloformulario.css" />
    </head>
    <form action="./validar_descuento.php" method="post" name="formulario_alta_descuento">
        <p>DATOS DEL NUEVO DESCUENTO </p>
        <div align="left">
            <p>
                Descuento:
                <input name="Descuento" type="text" maxlength="3">
                %
            </p>

            <p>Nombre del descuento: 
                <input name="NombreDescuento" type="text">
            </p>

            <p>Descripcion del descuento: 
                <br>
                <textarea name="DescripcionDescuento" cols="30" rows="10"></textarea> 
            </p>



            <p>
                Fecha Inicio: 
                <input type="date" name="FechaIni">
            </p>

            <p>
                Fecha Fin: 
                <input type="date" name="FechaFin">
            </p>

            <p>
                <input type="submit" name="Submit" value="Guardar">
            </p>
        </div>
        <a href="Menu_Gestor.html">Volver al Menú</a>

    </form>
</body>
</html>