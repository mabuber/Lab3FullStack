<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <title>Usuarios Registrados</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
    <?php
        //Conexion
        $host = "localhost";
        $usuario = "root";
        $password = "";
        $base_datos = "laboratorio";

        $conexion = new mysqli($host, $usuario, $password, $base_datos);

        if ($conexion -> connect_error) {
            die("Error de conexión a la base de datos:" . $conexion -> connect_error);
        }

        //Consulta usuarios
        $query = "SELECT * FROM usuarios";
        $resultado = $conexion -> query($query);

        if ($resultado -> num_rows > 0) {
            echo "<h2>Usuarios registrados</h2>";
            echo "<br>";
            echo "<table>";
            echo "<tr>";
            echo "<th>Nombre</th>";
            echo "<th>Primer apellido</th>";
            echo "<th>Segundo apellido</th>" ;
            echo "<th>Email</th>";
            echo "</tr>";

            while ($fila = $resultado -> fetch_assoc()) {
                echo "<tr>";
                echo "<td class='nombre'>{$fila['nombre']}</td>";
                echo "<td>{$fila['apellido1']}</td>";
                echo "<td>{$fila['apellido2']}</td>";
                echo "<td class='email'>{$fila['email']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        
        } else {
            echo "<p class='error'> No se encontraron registros de usuario.</p>";
        }

        //Cierre
        $conexion -> close();
    ?>

    <br>
    <button class="volver" onclick="window.location.href='index.html'">Volver al formulario</button>
    </body>
</html>