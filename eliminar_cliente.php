<?php
include 'db_config.php';
session_start();

// Verificar si el usuario ha iniciado sesión y si es "admin"
if (!isset($_SESSION['nombre']) || $_SESSION['nombre'] !== 'admin') {
    header('Location: dashboard.html');
    exit();
}

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM usuarios WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header('Location: clientes.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
