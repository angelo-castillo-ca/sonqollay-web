<?php
// Incluir el archivo de conexión a la base de datos y cualquier archivo de configuración necesario
include 'back/session.php'; // Suponiendo que tengas un archivo de conexión a la base de datos
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si se proporcionó un token de sesión válido en la solicitud POST
if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
    // Si el token no coincide o no se proporciona, enviar un mensaje de error
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(array('mensaje' => 'No autorizado'));
    exit;
}

// Obtener el saldo actual de monedas del usuario desde la base de datos
$usuario_id = $_SESSION['usuario_id'];
$query = "SELECT saldo_monedas FROM usuarios WHERE id = :usuario_id";
$stmt = $conexion->prepare($query);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$saldo_monedas = $row['saldo_monedas'];

// Verificar si el saldo actual es suficiente para realizar el descuento de 100 monedas
if ($saldo_monedas >= 100) {
    // Realizar el descuento de 100 monedas
    $nuevo_saldo = $saldo_monedas - 100;

    // Actualizar el saldo del usuario en la base de datos
    $query = "UPDATE usuarios SET saldo_monedas = :nuevo_saldo WHERE id = :usuario_id";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':nuevo_saldo', $nuevo_saldo);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->execute();

    // Devolver una respuesta indicando que la operación fue exitosa
    http_response_code(200); // Código de estado 200 - OK
    echo json_encode(array("mensaje" => "Monedas descontadas correctamente"));
} else {
    // El saldo no es suficiente, devolver un mensaje de error
    http_response_code(400); // Código de estado 400 - Solicitud incorrecta
    echo json_encode(array("mensaje" => "Saldo insuficiente"));
}
?>
