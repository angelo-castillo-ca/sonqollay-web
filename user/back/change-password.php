<?php
include '../../back/coneccion.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar la ID del usuario, contraseña actual, nueva contraseña y repetir contraseña desde el formulario
    $user_id = $_POST["user_id"];
    $pass_actual = $_POST["pass-actual"];
    $password = $_POST["password"];
    $password_repeat = $_POST["password-repeat"];

    // Validar que las contraseñas coincidan
    if ($password != $password_repeat) {
        echo "Las contraseñas no coinciden.";
    } else {
        // Preparar la consulta para verificar la contraseña actual
        $sql = "SELECT passwd FROM usuario WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($stored_password);
        $stmt->fetch();

        // Verificar la contraseña actual
        if (password_verify($pass_actual, $stored_password)) {
            // Si la contraseña es correcta, actualizarla con la nueva
            $new_password_hashed = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE usuario SET passwd = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $new_password_hashed, $user_id);
            if ($stmt->execute()) {
                echo "Contraseña actualizada correctamente.";
                header("Location: ../index.php");
                exit();
            } else {
                echo "Error al actualizar la contraseña: " . $stmt->error;
            }
        } else {
            echo "La contraseña actual es incorrecta.";
        }

        // Cerrar la declaración
        $stmt->close();
    }
}

// Cerrar la conexión
$conn->close();
?>