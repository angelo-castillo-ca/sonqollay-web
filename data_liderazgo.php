<?php

include 'back/coneccion.php';

// Establecer el encabezado para devolver JSON
header('Content-Type: application/json');

try {
    // Consulta SQL para obtener datos de la tabla liderazgo
    $sql = "SELECT * FROM preguntas where nombre=1";
    $result = $conn->query($sql);

    // Verificar errores en la consulta SQL
    if (!$result) {
        throw new Exception('Error en la consulta: ' . $conn->error);
    }

    // Obtener los resultados como un array asociativo
    $data = $result->fetch_all(MYSQLI_ASSOC);

    // Cerrar la conexión
    $conn->close();

    // Devolver los datos en formato JSON
    echo json_encode([
        "status" => "success",
        "message" => "Datos recibidos correctamente",
        "data" => $data
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (Exception $e) {
    // Manejar excepciones y devolver error en formato JSON
    echo json_encode([
        "status" => "error",
        "message" => "Ocurrió un error: " . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
?>
