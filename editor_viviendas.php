<?php
include 'db_config.php';
session_start();

// Verificar si el usuario ha iniciado sesión y si es "admin"
if (!isset($_SESSION['nombre']) || $_SESSION['nombre'] !== 'admin') {
    header('Location: dashboard.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styleditor.css">
    <title>Editor</title>
</head>
<body>

<h1 class="centrado_h1">Menú de edición de viviendas</h1>
<div class="centrado" class="form-container">
    <a href="agregar_vivienda.php" class="btn btn-outline-success btn-lg">Añadir</a>
    <a href="editar_vivienda.php" class="btn btn-outline-primary btn-lg">Editar</a>
    <a href="editar_vivienda.php" class="btn btn-outline-danger btn-lg">Eliminar</a>
</div>
    
<div class="mi-elemento">
    <a href="dashboard.html" class="btn btn-secondary">Volver al inicio</a>
</div>
</body>
</html>