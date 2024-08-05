<?php
// Establecer el encabezado JSON antes de cualquier salida
header('Content-Type: application/json');

try {
    // Habilitar reporte de errores
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Include the database connection file
    include 'back/coneccion.php';

    // Verificar la conexión a la base de datos
    if ($conn->connect_error) {
        throw new Exception("Error de conexión: " . $conn->connect_error);
    }

    // Verificar si se recibió el correo electrónico
    if (!isset($_POST['email'])) {
        throw new Exception('Email is required');
    }
    $correo = $_POST['email'];

    // Consulta para verificar si el correo electrónico ya está registrado
    $stmt = $conn->prepare('SELECT COUNT(*) FROM usuario WHERE correo = ?');
    if (!$stmt) {
        throw new Exception('Error al preparar la consulta');
    }

    if (!$stmt->bind_param('s', $correo)) {
        throw new Exception('Error al vincular parámetros');
    }

    if (!$stmt->execute()) {
        throw new Exception('Error al ejecutar la consulta');
    }

    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // Devolver el resultado como JSON
    echo json_encode(['exists' => $count > 0]);
} catch (Exception $e) {
    // Manejo de errores
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
    exit(); // Detiene la ejecución del script después de enviar la respuesta
}
?>
