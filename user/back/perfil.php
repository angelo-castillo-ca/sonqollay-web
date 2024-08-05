<?php
include '../../back/coneccion.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar el correo, nombres, apellido paterno y apellido materno desde el formulario
    $user_id = $_POST["user_id"];
    $correo = $_POST["email"];
    $nombres = $_POST["first_name"];
    $ape_paterno = $_POST["last_name1"];
    $ape_materno = $_POST["last_name2"];

    // Preparar la consulta para actualizar los datos del usuario
    $sql = "UPDATE usuario SET correo = ?, nombres = ?, apellido_paterno = ?, apellido_materno = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular los parámetros a la consulta
        $stmt->bind_param("sssss", $correo, $nombres, $ape_paterno, $ape_materno, $user_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Datos actualizados correctamente";
            header("Location: ../index.php");
            exit();
        } else {
            echo "Error al actualizar los datos: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
