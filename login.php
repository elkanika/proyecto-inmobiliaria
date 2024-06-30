<?php
include 'db_config.php';

// Obtener los valores enviados por el formulario
$usuario = $_POST['usuario'];
$palabra_secreta = $_POST['palabra_secreta'];

// Crear una consulta SQL para verificar las credenciales
$sql = "SELECT nombre, contrasena FROM usuarios WHERE nombre = '$usuario'";

// Ejecutar la consulta SQL
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    // El usuario existe en la base de datos
    $fila = $resultado->fetch_assoc();
    $contrasena_hash = $fila['contrasena'];


    // Verificar la contraseña (debes usar una función de hash aquí)
   if ($palabra_secreta === $contrasena_hash) {
        // Iniciar sesión y redirigir al área secreta
        session_start();
        $_SESSION["nombre"] = $usuario;
        header("Location: dashboard.html");
        exit;
    } else {
        echo "Contraseña incorrecta";
        /*echo $resultado;
        echo "Contraseña ingresada: " . $palabra_secreta;
        echo "Hash almacenado: " . $contrasena_hash;
        */
    }
} else {
    echo "Usuario no encontrado";
}

// Cierra la conexión a la base de datos
$conn->close();
