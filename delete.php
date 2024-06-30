<?php
include 'db_config.php';

if (isset($_GET['id'])) {
    $id_to_delete = $_GET['id'];

    // Obtener la ruta de la imagen desde la base de datos
    $sql = "SELECT foto FROM viviendas WHERE id = $id_to_delete";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagePath = 'uploads/' . $row['foto']; // Asegúrate de agregar el directorio correcto

        // Verificar si existe una imagen antes de intentar eliminarla
        if (!empty($row['foto']) && file_exists($imagePath)) {
            // Eliminar la imagen del servidor
            if (!unlink($imagePath)) {
                echo "Error deleting image from server. ";
            }
        }
    }

    // Proceder a eliminar el registro de la base de datos independientemente de la imagen
    $deleteSql = "DELETE FROM viviendas WHERE id = $id_to_delete";
    if ($conn->query($deleteSql) === TRUE) {
        header("Location: editar_vivienda.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No valid ID provided.";
}

$conn->close();

