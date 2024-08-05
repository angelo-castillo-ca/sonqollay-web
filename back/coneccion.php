<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "example";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

function obtenerConexion() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "example";

    $conn = new mysqli($servername, $username, $password, $dbname);

    return $conn;
}
?>
