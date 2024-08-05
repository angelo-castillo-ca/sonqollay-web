<?php
include '../coneccion.php';

// Consulta SQL para obtener datos de la tabla liderazgo
$sql = "SELECT * FROM gestion_tiempo";
$result = $conn->query($sql);

// Verificar errores en la consulta SQL
if (!$result) {
    die('Error en la consulta: ' . $conn->error);
}

// Obtener los resultados como un array asociativo
$data = $result->fetch_all(MYSQLI_ASSOC);

// Cerrar la conexión
$conn->close();

// Convertir caracteres Unicode a caracteres normales
$data = json_decode(json_encode($data, JSON_UNESCAPED_UNICODE), true);

// Nombre del archivo JSON
$filename = 'datos_gestion_tiempo.json';

// Escribir los datos en el archivo JSON con formato
file_put_contents($filename, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

// Imprimir mensaje de éxito
echo 'Archivo JSON generado exitosamente: ' . $filename;
?>
