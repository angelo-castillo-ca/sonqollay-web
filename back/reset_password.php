<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió el correo electrónico
    if (!isset($_POST['email'])) {
        throw new Exception('Email is required');
    }
    $correo = $_POST['email'];

    // Obtener los valores del formulario y sanitizarlos
    $email = htmlspecialchars($_POST["email"]);
    $newPassword = htmlspecialchars($_POST["newPassword"]);
    $confirmPassword = htmlspecialchars($_POST["confirmPassword"]);

    // Validar que las contraseñas coincidan
    if ($newPassword !== $confirmPassword) {
        echo "Las contraseñas no coinciden.";
        exit; // Detener la ejecución del script
    }

    // Validar que la contraseña tenga al menos 8 caracteres
    if (strlen($newPassword) < 8) {
        echo "La contraseña debe tener al menos 8 caracteres.";
        exit; // Detener la ejecución del script
    }

    // Hashizar la nueva contraseña
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Conexión a la base de datos
    include 'coneccion.php';

    // Consulta SQL preparada para actualizar la contraseña
    $sql = "UPDATE usuario SET passwd = ? WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashedPassword, $email);

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        echo "Contraseña actualizada correctamente.";
    } else {
        echo "Error al actualizar la contraseña: " . $stmt->error;
    }

    // Cerrar la conexión y liberar los recursos
    $stmt->close();
    $conn->close();
} else {
    // Si el formulario no se ha enviado correctamente, redireccionar al formulario de cambio de contraseña
    header("Location: recuperar.html");
    exit;
}
?>
