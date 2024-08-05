<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Verifica si el usuario está autenticado (tiene un user_id en la sesión)
if (isset($_SESSION['user_id'])) {
    $userId = intval($_SESSION['user_id']);
    include '/Applications/AMPPS/www/sonqollay/back/coneccion.php';
    // Ahora puedes utilizar $userId en tu consulta u otras operaciones
    // Ejemplo de uso en una consulta

    $sql = "SELECT id, nombres, apellido_paterno, apellido_materno,correo,rol,creditos,avatar FROM usuario WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Procesar los resultados de la consulta
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Almacena el nombre del usuario en una variable de sesión
        $_SESSION['nombre_usuario'] = $row['nombres'];
        $_SESSION['correo'] = $row['correo'];
        $_SESSION['apellido_paterno'] = $row['apellido_paterno'];
        $_SESSION['apellido_materno'] = $row['apellido_materno'];
        $_SESSION['creditos'] = $row['creditos'];
        $_SESSION['rol'] = $row['rol'];
        $_SESSION['avatar_usuario'] = $row['avatar'];
        $_SESSION['nombre_completo_usuario'] = $row['nombres'] . ' ' . $row['apellido_paterno'];
    } else {
        // Manejar el caso en que no se encuentra el usuario
        echo "Error: No se encontró el usuario.";
    }

    $stmt->close();
    $conn->close();
} else {
    // El usuario no está autenticado, redirige a la página de inicio de sesión
    header("Location: ../../ingreso.html");
    exit();
}
?>
