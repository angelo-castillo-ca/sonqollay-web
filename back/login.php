<?php
// Incluye el archivo de conexión a la base de datos
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'coneccion.php';

    // Recuperar los datos del formulario
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Consulta para verificar las credenciales del usuario con consultas preparadas
    $sql = "SELECT id, correo, passwd, rol FROM usuario WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar las credenciales del usuario con password_verify
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['passwd'])) {
            // Credenciales válidas, iniciar la sesión y guardar el ID y el rol del usuario
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['rol'];

            // Redirigir según el rol del usuario
            if ($row['rol'] == 'admin') {
                header("Location: ../admin/confirmacion_ingreso.php");
            } elseif ($row['rol'] == 'user') {
                header("Location: ../user/back/confirmacion_ingreso.php");
            } else {
                // En caso de que el rol no sea reconocido, redirigir a una página de error
                header("Location: error.php");
            }
            exit();
        } else {
            // Credenciales inválidas, mostrar mensaje de error
            echo "Credenciales incorrectas. Por favor, intenta de nuevo.";
        }
    } else {
        // Correo electrónico no encontrado, mostrar mensaje de error
        echo "Credenciales incorrectas. Por favor, intenta de nuevo.";
    }

    // Cerrar la conexión después de usarla
    $stmt->close();
    $conn->close();
}
?>
