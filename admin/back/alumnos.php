<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the database connection file
include '../../back/coneccion.php';

    // Consulta SQL para recuperar modulos
    $sql = "SELECT * FROM usuario";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Array para almacenar modulos
        $user = array();
    
        // Recorrer resultados y almacenar en el array
        while($row = $result->fetch_assoc()) {
            $user[] = $row;
        }
    
        // Convertir array a formato JSON y devolverlo
        echo json_encode($user);
    } else {
        echo "0 resultados";
    }
    
    $conn->close();
    ?>
    