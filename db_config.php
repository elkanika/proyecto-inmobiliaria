<?php
$servername = "localhost";
$username = "c1621890_inmo";
$password = "wuGO93zowe";
$dbname = "c1621890_inmo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

