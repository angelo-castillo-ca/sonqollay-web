<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
date_default_timezone_set('America/Lima');

// Verifica si el usuario está autenticado (tiene un user_id en la sesión)
if (isset($_SESSION['user_id'])) {
    $userId = intval($_SESSION['user_id']);
   // include '/Applications/AMPPS/www/sonqollay/back/coneccion.php';
    include '../back/coneccion.php';
    // Ahora puedes utilizar $userId en tu consulta u otras operaciones
    // Ejemplo de uso en una consulta


    $sql = "SELECT id, nombres, apellido_paterno, apellido_materno,correo,avatar,creditos FROM usuario WHERE id = ?";
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
        $_SESSION['avatar_usuario'] = $row['avatar'];
        $_SESSION['creditos'] = $row['creditos'];
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
//comienzo pasarela
$conn = obtenerConexion();



function obtenerPlanPorId($id){
    global $conn;
    $query = "SELECT * FROM planes where id={$id}";
    $result = mysqli_query($conn, $query);

    return $result;
}


function registroTransacciones($data, $idPlan, $dataReal) {
    $idUsuario = $_SESSION['user_id'];

    // Decodifica el JSON a un array asociativo
  //  $data = json_decode($dataReal, true);

//    print_r($data['orderDetails']);
//    exit;

    guardarTransaccion(
        $idUsuario,
        $data['orderDetails']['orderId'],
        $data['transactions'][0]['transactionDetails']['cardDetails']['pan'],
        $data['transactions'][0]['transactionDetails']['cardDetails']['effectiveBrand'],
        null,
        $dataReal,
        $data['transactions'][0]['detailedStatus'],
        $data['transactions'][0]['detailedStatus'],
        intval($data['transactions'][0]['amount']) / 100,
        $data['transactions'][0]['detailedStatus']
    );

    guardarPago($idUsuario, $data['transactions'][0]['creationDate'], $idPlan);
    aumentarCredito($idUsuario, $idPlan);
}

function guardarTransaccion($usuario_id, $niubiz_purchaseNumber, $niubiz_cardNumber, $niubiz_typeCard, $niubiz_request, $niubiz_response, $observaciones, $estado, $monto, $niubiz_status){
    global $conn;
    $sql = "INSERT INTO transacciones (usuario_id, niubiz_purchaseNumber, niubiz_cardNumber, niubiz_typeCard, niubiz_request, niubiz_response, observaciones, estado, monto, niubiz_status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssds", $usuario_id, $niubiz_purchaseNumber, $niubiz_cardNumber, $niubiz_typeCard, $niubiz_request, $niubiz_response, $observaciones, $estado, $monto, $niubiz_status);
    $stmt->execute();
}

function guardarPago($usuario_id, $fecha_inicio, $plan_id) {
    global $conn;
    $sql = "INSERT INTO pagos (usuario_id, fecha_inicio, plan_id) VALUES (?, ?, ?)";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $usuario_id, $fecha_inicio, $plan_id);
    $stmt->execute();

}

function aumentarCredito($idUsuario, $idPlan) {
    global $conn;
    $sqlPlan = "SELECT creditos from planes where id = ?";
    $stmtPlan= $conn->prepare($sqlPlan);
    $stmtPlan->bind_param("i", $idPlan);
    $stmtPlan->execute();
    $stmtPlan->bind_result($creditosPlan);
    $stmtPlan->fetch();
    $stmtPlan->close();
    // Consulta SQL para aumentar el crédito del usuario
    $sql = "UPDATE usuario SET creditos = creditos + ? WHERE id = ?";
    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $creditosPlan, $idUsuario);
    $stmt->execute();
    $stmt->close();
}
//fin pasarela

?>
