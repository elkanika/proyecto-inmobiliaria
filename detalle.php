<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de la Vivienda</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Detalle de la Vivienda</h1>
        <?php
        // Incluir el archivo de conexión a la base de datos
        include 'db_config.php';

        // Verificar si se ha pasado el parámetro id en la URL
        if(isset($_GET['id'])) {
            // Obtener el id de la vivienda desde la URL
            $vivienda_id = $_GET['id'];

            // Consulta SQL para obtener los detalles de la vivienda específica
            $sql = "SELECT * FROM viviendas WHERE id = $vivienda_id";
            $result = $conn->query($sql);

            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                // Mostrar los detalles de la vivienda
                $row = $result->fetch_assoc();
                echo '<img src="uploads/' . $row["foto"] . '" class="img-fluid mb-4" alt="Imagen de la vivienda">'; // Mostrar la foto de la vivienda
                echo '<p>Dirección: ' . $row["direccion"] . '</p>';
                echo '<p>Tipo: ' . $row["tipo"] . '</p>';
                echo '<p>Zona: ' . $row["zona"] . '</p>';
                echo '<p>Precio: $' . $row["precio"] . '</p>';
                echo '<p>Descripción: ' . $row["observaciones"] . '</p>';
                echo '<p>Extras: ' . $row["extras"] . '</p>';
                
            } else {
                // Mostrar un mensaje si no se encontraron detalles para esta vivienda
                echo "<p>No se encontró información para esta vivienda.</p>";
            }
        } else {
            // Mostrar un mensaje si no se proporcionó una vivienda válida
            echo "<p>No se ha proporcionado una vivienda válida.</p>";
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
        ?>
        <!-- Agregar un enlace para volver a la lista de viviendas -->
        <a href="viviendas.php" class="btn btn-primary">Volver a la Lista de Viviendas</a>
    </div>
</body>
</html>
