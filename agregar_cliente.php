<?php
include 'db_config.php';
session_start();

// Verificar si el usuario ha iniciado sesión y si es administrador
if (!isset($_SESSION['nombre']) || $_SESSION['nombre'] != 'admin') {
    header('Location: dashboard.html');
    exit();
}

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contrasena'];

    $sql = "INSERT INTO usuarios (nombre, contrasena) VALUES ('$nombre', '$contraseña')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo cliente agregado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<a href="clientes.php">Volver a la Gestión de Clientes</a>
