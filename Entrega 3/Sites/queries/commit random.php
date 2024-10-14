if (isset($_SESSION['username'])) {
    echo "<h2 class='subtitle'>Bienvenido, {$_SESSION['username']}!</h2>";
} else {
    echo "<h2 class='subtitle'>No hay usuario</h2>";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Título Aquí</title>
</head>

<body>

<section class="section">
        <form action="registro.php" method="post">
            <input type="text" name="username" placeholder="Nombre de usuario" required>
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="date" name="fecha_nacimiento" required>
        </form>

        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Nombre de usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="submit" value="Iniciar sesión">
        </form>
    </section>
</body>
</html>

<?php
include('../config/conexion.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['username']) && isset($_POST['password'])) {
    }

    if (isset($_POST['username']) && isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['fecha_nacimiento'])) {
    }
}

if (isset($_SESSION['id_usuario'])) {
}
?>






-----------------



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    ## Verificar si el username ya existe en la base de datos
    $check_query = "SELECT * FROM Usuarios WHERE username = '$username'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "El nombre de usuario ya está en uso. Por favor, elige otro.";
    } else {
        ## Obtener el máximo ID de usuario existente
        $max_id_query = "SELECT MAX(id_usuario) AS max_id FROM Usuarios";
        $max_id_result = $conn->query($max_id_query);
        $row = $max_id_result->fetch_assoc();
        $max_id = $row['max_id'];

        ## Nuevo ID para el usuario
        $new_id = $max_id + 1;

        ## Insertar nuevo usuario
        $insert_query = "INSERT INTO Usuarios (id_usuario, username, nombre, email, fecha_nacimiento) VALUES ('$new_id', '$username', '$nombre', '$email', '$fecha_nacimiento')";

        if ($conn->query($insert_query) === TRUE) {
            echo "Usuario registrado exitosamente";
            // Redirigir al usuario a otra página después del registro si lo deseas
            header("Location: ../ruta/a/otra_pagina.php");
            exit();
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
        }
    }
}



<!---


<form action="login.php" method="post">
    <input type="text" name="username" placeholder="Nombre de usuario" required>
    <input type="password" name="password" placeholder="Contraseña" required>
</form>

session_start();
include('../config/conexion.php'); // Asegúrate de tener la conexión a la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check_query = "SELECT * FROM Usuarios WHERE username = '$username'";
    $result = $conn->query($check_query);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['contrasena'])) {
            ## Las credenciales son correctas
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['nombre'] = $row['nombre'];
            ##Otras asignaciones de sesión si es necesario

            ##Redirigir al usuario a su perfil
            header("Location: mi_perfil.php");
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
}

session_start();
include('../config/conexion.php'); ## Asegúrate de tener la conexión a la base de datos

if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];

    $query_usuario = "SELECT nombre, email, username, edad FROM Usuarios WHERE id_usuario = $id_usuario";
    $result_usuario = $conn->query($query_usuario);

    if ($result_usuario->num_rows > 0) {
        $row_usuario = $result_usuario->fetch_assoc();
        $nombre = $row_usuario['nombre'];
        $email = $row_usuario['email'];
        $username = $row_usuario['username'];
        $edad = $row_usuario['edad'];

        ## Mostrar la información del usuario
        echo "<h1>Mi Perfil</h1>";
        echo "<h2>Información Personal:</h2>";
        echo "<p><strong>Nombre:</strong> $nombre</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Username:</strong> $username</p>";
        echo "<p><strong>Edad:</strong> $edad años</p>";

    } else {
        echo "Usuario no encontrado";
    }
} else {
    echo "Debes iniciar sesión para ver esta página";
}


?>