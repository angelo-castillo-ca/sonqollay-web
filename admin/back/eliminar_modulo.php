<?php
// Mostrar errores solo en entorno de desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir el archivo de conexión a la base de datos
include '../../back/coneccion.php';

// Verificar que la conexión a la base de datos esté establecida
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Error de conexión a la base de datos']));
}

// Verificar que se haya proporcionado un ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Iniciar transacción
    $conn->begin_transaction();

    // Ejemplo de consulta de eliminación
    $sql = "DELETE FROM modulos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        // Actualizar los IDs de los registros restantes
        $sql_reorder = "SET @count = 0;
                        UPDATE modulos SET id = @count:= @count + 1;
                        ALTER TABLE modulos AUTO_INCREMENT = 1;";
        if ($conn->multi_query($sql_reorder)) {
            // Confirmar transacción
            $conn->commit();
            echo json_encode(['success' => true, 'message' => 'Modulo eliminado y IDs actualizados exitosamente']);
        } else {
            // Revertir transacción en caso de error
            $conn->rollback();
            echo json_encode(['success' => false, 'error' => 'Error al actualizar los IDs']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al eliminar el modulo']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'ID no proporcionado']);
}
?>
