<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the database connection file
include '../../back/coneccion.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $nombre = $_POST['nombre'];
    $creditos = 0;


    // Insert data into the database
    $sql = "INSERT INTO modulos (nombre,creditos) VALUES ('$nombre',$creditos)";

    if ($conn->query($sql) === TRUE) {
        // Registro exitoso, redirige a la página de confirmación
        echo json_encode(['success' => true, 'message' => 'Los cambios se guardaron correctamente', 'redirect_url' => '../modulos.php']);
        header("Location: ../modulos.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}

// Close the database connection (optional since PHP automatically closes it at the end of the script)
$conn->close();
?>
