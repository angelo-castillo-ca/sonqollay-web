<?php
// Mostrar errores solo en entorno de desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir el archivo de conexión a la base de datos
include '../../back/coneccion.php';

// Verificar si se enviaron datos de formulario de manera segura
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['id'], $_POST['nombre'], $_POST['creditos'])) {
        // Obtener los datos del formulario
        $id = $_POST['id'];
        $nombre = htmlspecialchars($_POST['nombre']);
        $creditos = intval($_POST['creditos']);

        // Consulta preparada para actualizar los datos del módulo
        $sql = "UPDATE modulos SET nombre=?, creditos=? WHERE id=?";

        // Preparar la consulta
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Vincular parámetros y ejecutar la consulta
            $stmt->bind_param("sii", $nombre, $creditos, $id);
            if ($stmt->execute()) {
                // Si la actualización fue exitosa
                echo json_encode(['success' => true, 'message' => 'Los cambios se guardaron correctamente', 'redirect_url' => 'modulos.php']);
            } else {
                // Si hubo un error al ejecutar la consulta
                echo json_encode(['success' => false, 'error' => 'Error al ejecutar la consulta: ' . $stmt->error]);
            }
            // Cerrar la declaración preparada
            $stmt->close();
        } else {
            // Si hubo un error al preparar la consulta
            echo json_encode(['success' => false, 'error' => 'Error al preparar la consulta: ' . $conn->error]);
        }
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
