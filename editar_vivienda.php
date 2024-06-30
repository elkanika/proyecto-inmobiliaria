<?php 
include 'db_config.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    


<?php
echo "<table class='tabla-viviendas table'>";
echo "<tr><th class='table-dark'>Tipo</th><th class='table-dark'>Zona</th><th class='table-dark'>Dormitorios</th><th class='table-dark'>Precio</th><th class='table-dark'>Tamaño</th><th class='table-dark'>Extras</th><th class='table-dark'>Fotos</th><th class='table-dark'>Observaciones</th><th class='table-dark'>Editar/Eliminar</th></tr>";
$result = $conn->query("SELECT id, tipo, zona, dormitorios, precio, tamano, extras, foto, observaciones FROM viviendas");

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["tipo"]. "</td>
                <td>" . $row["zona"]. "</td>
                <td>" . $row["dormitorios"]. "</td>
                <td>" . $row["precio"]. "</td>
                <td>" . $row["tamano"]. "</td>
                <td>" . $row["extras"] . "</td>
                <td><img src='uploads/" . $row["foto"] . "' alt='' ></td>
                <td>" . $row['observaciones'] . "</td>

                <td> <a href='edicion_viviendas.php?id={$row['id']}'>Editar</a>
                    <a href='delete.php?id={$row['id']}'>Borrar</a>
                </td>
              </tr>";        
    }
} else {
    echo "<tr><td colspan='6'>0 resultados</td></tr>";
}
echo "</table>";
$conn->close();
?>
<a href="editor_viviendas.html">Volver al inicio</a>
</body>
</html>