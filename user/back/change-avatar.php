<?php
include 'session.php';
include '/Applications/AMPPS/www/sonqollay/back/coneccion.php'; // Asegúrate de que esta ruta sea correcta
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profilePhoto'])) {
    $userId = $_SESSION['user_id'];
    $nombres = $_SESSION['nombre_usuario']; // Asegúrate de que esta variable está bien definida en la sesión
    $avatarNuevo = $_FILES['profilePhoto'];

    // Verificar si el archivo fue subido sin errores
    if ($avatarNuevo['error'] == 0) {
        // Ruta de destino para la subida del archivo
        $uploadDir = '/Applications/AMPPS/www/sonqollay/assets/img/avatars/';
        $dir = '../assets/img/avatars/';
        $fileExt = pathinfo($avatarNuevo['name'], PATHINFO_EXTENSION);
        $newFileName = $userId . '-' . $nombres . '.' . $fileExt;
        $uploadFile = $uploadDir . $newFileName;
        $ruta = $dir . $newFileName;

        // Mover el archivo subido a la ubicación deseada
        if (move_uploaded_file($avatarNuevo['tmp_name'], $uploadFile)) {
            // Actualizar la ruta de la imagen en la base de datos
            $sql = "UPDATE usuario SET avatar = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $ruta, $userId);

            if ($stmt->execute()) {
                // Actualizar la ruta de la imagen en la sesión
                $_SESSION['avatar_usuario'] = $ruta;
                echo "Foto de perfil actualizada correctamente.";
                header("Location: ../index.php");
                exit();
            } else {
                echo "Error al actualizar la foto de perfil en la base de datos: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error al mover el archivo subido.";
        }
    } else {
        echo "Error al subir el archivo: " . $avatarNuevo['error'];
    }
} else {
    echo "No se ha recibido ningún archivo.";
}

$conn->close();
?>
