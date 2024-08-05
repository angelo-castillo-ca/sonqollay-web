<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the database connection file
include '../../back/coneccion.php';

// Verificar si se proporcionó un ID de modulo válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Escapar el ID del modulo para evitar inyecciones SQL
    $moduloId = $_GET['id'];
    
    // Consultar la base de datos para obtener los detalles del modulo
    $sql = "SELECT * FROM modulos WHERE id = '$moduloId'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // Convertir el resultado en un array asociativo
            $row = $result->fetch_assoc();

            // Devolver los detalles del modulo como respuesta JSON
            header('Content-Type: application/json');
            echo json_encode($row);
        } else {
            // Si no se encontró ningún modulo con el ID proporcionado
            echo json_encode(['error' => 'No se encontró ningún modulo con el ID proporcionado']);
        }
    } else {
        // Si hay un error en la consulta SQL
        echo json_encode(['error' => 'Error en la consulta SQL: ' . $conn->error]);
    }
} else {
    // Si no se proporcionó un ID de modulo válido
    echo json_encode(['error' => 'ID de modulo no válido']);
}

// Cerrar conexión
$conn->close();
?>
