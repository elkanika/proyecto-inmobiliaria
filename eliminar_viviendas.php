<?php
include 'db_config.php';

// Verificar si se ha enviado el formulario y si se ha recibido un ID válido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];


    if (isset($_POST["confirm"]) && $_POST["confirm"] === "yes") {
        // Preparar la consulta SQL para evitar inyecciones SQL
        $stmt = $conn->prepare("DELETE FROM viviendas WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Vivienda eliminada correctamente.";
        } else {
            echo "Error al eliminar la vivienda: " . $conn->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo "Por favor, confirme la eliminación.";
    }
} else {

    echo "Por favor, seleccione una vivienda para eliminar.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar viviendas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Eliminar viviendas</h2>
    <?php
    // Obtener el ID de la vivienda si está disponible
    $id = $_GET["id"] ?? "";
    ?>

    <form action="eliminar_viviendas.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <p>¿Estás seguro de que quieres eliminar la vivienda con ID <?php echo htmlspecialchars($id); ?>?</p>
        <input type="hidden" name="confirm" value="yes">

        <button type="submit" name="submit">Eliminar</button>
        <button type="button" onclick="window.history.back();">Cancelar</button>
    </form>
    <a href="editar_vivienda.php">Volver a administrar viviendas</a>
</body>
</html>