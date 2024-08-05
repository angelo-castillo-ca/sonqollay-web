<?php
// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir el archivo de conexión a la base de datos
include '../../back/coneccion.php';

// Verificar si se enviaron datos de formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario de manera segura
    $id = $_POST['id'];
    $nombres = htmlspecialchars($_POST['nombres']);
    $apellido_paterno = htmlspecialchars($_POST['apellido_paterno']);
    $apellido_materno = htmlspecialchars($_POST['apellido_materno']);
    $correo = htmlspecialchars($_POST['correo']);
    $passwd = htmlspecialchars($_POST['passwd']);
    $rol = htmlspecialchars($_POST['rol']);
    $creditos = isset($_POST['creditos']) ? intval($_POST['creditos']) : 0; // Convertir a entero y establecer como cero si no está definido

    // Consulta preparada para actualizar los datos del usuario
    $sql = "UPDATE usuario SET nombres=?, apellido_paterno=?, apellido_materno=?, correo=?, passwd=?, rol=?, creditos=? WHERE id=?";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("ssssssii", $nombres, $apellido_paterno, $apellido_materno, $correo, $passwd, $rol, $creditos);
        if ($stmt->execute()) {
            // Si la actualización fue exitosa
            echo json_encode(['success' => true, 'message' => 'Los cambios se guardaron correctamente', 'redirect_url' => 'alumnos.php']);
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
    // Si no se recibieron datos de formulario
    echo json_encode(['success' => false, 'error' => 'No se recibieron datos de formulario']);
}

// Cerrar conexión
$conn->close();
?>
