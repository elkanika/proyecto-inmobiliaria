<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $id = $_POST["id"];
    $tipo = $_POST["tipo"];
    $zona = $_POST["zona"];
    $dormitorios = $_POST["dormitorios"];
    $tamano = $_POST["tamano"];
    $precio = $_POST["precio"];
    $extras = $_POST["extras"];
    $observaciones = $_POST["observaciones"];

    // Verificar si se ha subido una nueva imagen
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["foto"]["name"]);
        $targetFile = $targetDir . $fileName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Intenta mover la foto al directorio de subida
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
            echo "Imagen actualizada correctamente. ";
            // Si la imagen se subió, actualizar la ruta en la base de datos
            $foto = $fileName;
        } else {
            echo "Error al subir la imagen. ";
            $foto = $viviendas['foto']; // Conservar la imagen anterior si falla la subida
        }
    } else {
        $foto = $viviendas['foto']; // No se subió una nueva imagen
    }

    $update_query = "UPDATE viviendas SET tipo='$tipo', zona='$zona', dormitorios='$dormitorios', tamano='$tamano', precio='$precio', extras='$extras', foto='$foto', observaciones='$observaciones' WHERE id=$id";
    if ($conn->query($update_query) === TRUE) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar datos: " . $conn->error;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $query_viviendas = "SELECT * FROM viviendas WHERE id = $id";
    $result_viviendas = $conn->query($query_viviendas);

    if ($result_viviendas->num_rows > 0) {
        $viviendas = $result_viviendas->fetch_assoc();
    } else {
        echo "No se encontró la vivienda con ID $id";
        exit();
    }
} else {
    echo "Acceso no permitido.";
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar viviendas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Editar viviendas</h2>
    <form action="edicion_viviendas.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $viviendas['id']; ?>">

        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" value="<?php echo $viviendas['tipo']; ?>" required>

        <label for="zona">Zona:</label>
        <input type="text" name="zona" value="<?php echo $viviendas['zona']; ?>" required>

        <label for="dormitorios">Dormitorios:</label>
        <input type="text" name="dormitorios" value="<?php echo $viviendas['dormitorios']; ?>" required>

        <label for="tamano">Tamaño:</label>
        <input type="text" name="tamano" value="<?php echo $viviendas['tamano']; ?>" required>

        <label for="precio">Precio:</label>
        <input type="text" name="precio" value="<?php echo $viviendas['precio']; ?>" required>

        <label for="extras">Extras:</label>
        <input type="text" name="extras" value="<?php echo $viviendas['extras']; ?>">

        <label for="observaciones">Observaciones:</label>
        <textarea name="observaciones"><?php echo $viviendas['observaciones']; ?></textarea>

        <label for="foto">Cambiar Imagen:</label>
        <input type="file" name="foto">

        <button type="submit" name="submit">Guardar cambios</button>
    </form>
    <a href="editar_vivienda.php">Volver a administrar viviendas</a>
</body>
</html>
