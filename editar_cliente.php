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
    $result = $conn->query("SELECT * FROM usuarios WHERE id = $id");
    $cliente = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    $nombre = $conn->real_escape_string($nombre);
    $contrasena = $conn->real_escape_string($contrasena);

    $sql = "UPDATE usuarios SET nombre='$nombre', contrasena='$contrasena' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: clientes.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="style_dash.css">
</head>
<body>
    <div class="navbar">
        <a href="viviendas.php">Ver viviendas</a>
        <a href="editor_viviendas.html">Editar viviendas</a>
        <a href="clientes.php">Gestión de clientes</a>
        <a href="logout.php">Cerrar sesión</a>
    </div>
    <div class="content">
        <h1>Editar Cliente</h1>
        <form action="editar_cliente.php" method="post">
            <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $cliente['nombre']; ?>" required>
            <br>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" value="<?php echo $cliente['contrasena']; ?>" required>
            <br>
            <input type="submit" value="Actualizar Cliente">
        </form>
    </div>
</body>
</html>
