<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the database connection file
include 'coneccion.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $firstName = $_POST['nombres'];
    $lastName1 = $_POST['apellido_materno'];
    $lastName2 = $_POST['apellido_paterno'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verifyPassword = $_POST['verifyPassword'];
    $genero = $_POST["gender"];
    $rol = 'user';
    $creditos = 0;

    // Validate the data
    if ($password != $verifyPassword) {
        echo "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
        exit();
    }
    if ($genero === 'M') {
        $avatar = '../assets/img/avatars/hombre.png';
    } elseif ($genero === 'F') {
        $avatar = '../assets/img/avatars/mujer.png';
    } else {
        die("Género inválido.");
    }

    // Hash de la contraseña (puedes usar algoritmos más seguros en un entorno de producción)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO usuario (nombres, apellido_materno,apellido_paterno, genero, correo, passwd,rol,avatar,creditos) VALUES ('$firstName', '$lastName1', '$lastName2', '$genero', '$email', '$hashedPassword', '$rol', '$avatar', $creditos)";

    if ($conn->query($sql) === TRUE) {
        // Registro exitoso, redirige a la página de confirmación
        header("Location: confirmacion_registro.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection (optional since PHP automatically closes it at the end of the script)
$conn->close();
?>
