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

$clientes = $conn->query("SELECT * FROM usuarios");

// Aquí puedes añadir la lógica para gestionar clientes (agregar, modificar, eliminar)
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
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
        <h1>Gestión de Clientes</h1>
        <!-- Formulario para agregar un nuevo cliente -->
        <form action="agregar_cliente.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <br>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
            <br>
            <input type="submit" value="Agregar Cliente">
        </form>

        <h2>Clientes Existentes</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Contraseña</th>
            </tr>
            <?php while ($cliente = $clientes->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo $cliente['nombre']; ?></td>
                    <td><?php echo $cliente['contrasena']; ?></td>
                    <td>
                        <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>">Editar</a>
                        <a href="eliminar_cliente.php?id=<?php echo $cliente['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>