<?php
$servername = "localhost";
$username = "root";
$password = "123456789"; // Cambia esto si tienes una contraseña para MySQL
$dbname = "registro_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
