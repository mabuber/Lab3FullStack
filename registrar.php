<?php
    //Eviar inyeccion SQL!
    //Conexion 
    $host = "localhost";
    $usuario = "root";
    $password = "";
    $base_datos = "laboratorio";

    $conexion = new mysqli($host, $usuario, $password, $base_datos);

    if ($conexion -> connect_error ) {
        die("Error de conexión a la base de datos:" . $conexion -> connect_error);
    }

    //Validacion
    $nombre = validarCampo("nombre");
    $apellido1 = validarCampo("apellido1");
    $apellido2 = validarCampo("apellido2");
    $email = validarCampo("email");
    $password = validarCampo("password");

    function validarCampo($campo)
    {
        if (empty($_POST[$campo])) {
            die("Todos los campos son obligatorios.");
        }
        return $_POST[$campo];
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("El correo electrónico no tiene un formato válido.");
    }

    //Comprobar si el mail ya existia 
    $query = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion -> prepare($query);
    $stmt -> bind_param("s",  $email);
    $stmt -> execute();
    $resultado = $stmt -> get_result();

    if ($resultado-> num_rows > 0) {
        die("El correo electrónico ya está registrado.");
    }

    //Introduccion
    $query = "INSERT INTO usuarios (nombre, apellido1, apellido2, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion -> prepare($query);
    $stmt -> bind_param("sssss", $nombre, $apellido1, $apellido2, $email, $password);
    $stmt -> execute();

    if ($stmt -> affected_rows > 0) {
        echo "Registro completado con éxito.";
    } else {
        echo "Error al registrar el usuario.";
    }

    //Cierre
    $conexion -> close();
?>