<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <form action="agregar_vivienda.php" method="post" enctype="multipart/form-data">
    <input name="tipo" class="form-control form-control-lg" type="text" placeholder="Tipo de vivienda" aria-label=".form-control-lg example">
    <input name="zona" class="form-control form-control-lg" type="text" placeholder="Zona de la vivienda" aria-label=".form-control-lg example">
    <input name="dormitorios" class="form-control form-control-lg" type="text" placeholder="Cantidad de dormitorios" aria-label=".form-control-lg example">
    <input name="tamano" class="form-control form-control-lg" type="text" placeholder="Tamaño de vivienda" aria-label=".form-control-lg example">
    <input name="precio" class="form-control form-control-lg" type="text" placeholder="Precio de la vivienda" aria-label=".form-control-lg example">
    <input name="extra" class="form-control form-control-lg" type="text" placeholder="Extra de la vivienda" aria-label=".form-control-lg example">
    <input type="file" name="foto" accept="image/*">
    <input name="observaciones" class="form-control form-control-lg" type="text" placeholder="Extra de la vivienda" aria-label=".form-control-lg example">
    <button type="submit" name = "submit" value="Agregar viviendas" class="btn btn-primary">Enviar</button>
    </form>

<?php
include "db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $targetDir = "uploads/";  // Puedes ajustar esto según donde desees guardar las imágenes
    $fileName = basename($_FILES["foto"]["name"]);
    $targetFile = $targetDir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar si el archivo es realmente una imagen
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
        // Intenta mover la foto al directorio de subida
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
            echo "Foto subida correctamente. ";

            // Preparar datos para insertar en la base de datos
            $Tipo = mysqli_real_escape_string($conn, $_POST["tipo"]);
            $Zona = mysqli_real_escape_string($conn, $_POST["zona"]);
            $Dormitorios = mysqli_real_escape_string($conn, $_POST["dormitorios"]);
            $Tamano = mysqli_real_escape_string($conn, $_POST["tamano"]);
            $Precio = mysqli_real_escape_string($conn, $_POST["precio"]);
            $Extras = mysqli_real_escape_string($conn, $_POST["extra"]); // Asegúrate de que el nombre del campo sea correcto aquí
            $Observaciones = mysqli_real_escape_string($conn, $_POST["observaciones"]);
            $Foto = $fileName;  // Solo guardamos el nombre del archivo

            $insert_query = "INSERT INTO viviendas (tipo, zona, dormitorios, tamano, precio, extras, foto, observaciones) 
                             VALUES ('$Tipo', '$Zona', '$Dormitorios', '$Tamano', '$Precio', '$Extras', '$Foto', '$Observaciones')";

            if ($conn->query($insert_query) === TRUE) {
                echo "Nueva vivienda agregada correctamente. ";
            } else {
                echo "Error al agregar vivienda: " . $conn->error;
            }
        } else {
            echo "Error al subir la foto. Verifica los permisos de la carpeta y la ruta.";
            $uploadOk = 0;
        }
    } else {
        echo "El archivo no es una imagen válida.";
        $uploadOk = 0;
    }
}
?>

<a href="editor_viviendas.html" class="btn btn-secondary">Volver</a>
</body>
</html>