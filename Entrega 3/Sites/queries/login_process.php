<?php
require("./config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $password = $_POST['password']; 

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header('Location: register.php?error=Username already exists');
        exit;
    } else {
        $sql = "INSERT INTO users (username, name, email, dob, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $username, $name, $email, $dob, $password);
        $stmt->execute();

        header('Location: login.php?message=Registration successful, you can now log in');
        exit;
    }
}

$conn->close();
?>