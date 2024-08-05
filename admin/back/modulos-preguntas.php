<?php
// Mostrar errores solo en entorno de desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir el archivo de conexión a la base de datos
include '../../back/coneccion.php';

// Verificar si se enviaron datos de formulario de manera segura
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['id'])) {
        // Obtener los datos del formulario
        $id = $_GET['id'];
        $sql="SELECT preguntas.* FROM modulos INNER JOIN modulos on preguntas.nombre = modulos.id WHERE modulos.nombre =?;";
        
        // Consulta preparada para actualizar los datos del módulo

        // Preparar la consulta
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Vincular parámetros y ejecutar la consulta
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $modulos = array();
            while($row = $result->fetch_assoc()) {
                $modulos[] = $row;
            }
            echo json_encode($modulos);
        } else {
            // Si hubo un error al preparar la consulta
            echo json_encode(['success' => false, 'error' => 'Error al preparar la consulta: '. $conn->error]);
        }
        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        // Si no se recibieron todos los datos de formulario necesarios
        echo json_encode(['success' => false, 'error' => 'No se recibieron todos los datos de formulario necesarios']);
    }
} else {
    // Si no se recibió una solicitud POST
    echo json_encode(['success' => false, 'error' => 'No se recibió una solicitud POST']);
}

// Cerrar conexión
$conn->close();
?>