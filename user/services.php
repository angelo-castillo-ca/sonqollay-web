<?php

include '../back/coneccion.php';

$conn = obtenerConexion();
function listaPlanes(){
    global $conn;
    $query = "SELECT * FROM planes";
    $result = mysqli_query($conn, $query);

    return $result;
}


function obtenerPlanPorId($id){
    global $conn;
    $query = "SELECT * FROM planes where id={$id}";
    $result = mysqli_query($conn, $query);

    return $result;
}


function registroTransacciones ($data){
    if (isset($data->dataMap)){
        guardarTransaccion(1, $data->order->purchaseNumber, $data->dataMap->CARD, $data->dataMap->BRAND, null, json_encode($data), $data->dataMap->ECI_DESCRIPTION, $data->dataMap->ACTION_DESCRIPTION,$data->dataMap->AMOUNT, $data->dataMap->STATUS );
        guardarPago(1,$data->dataMap->TRANSACTION_DATE, "Plan Basico" );
        aumentarCredito(1, 40);
    }else{
        guardarTransaccion(1,null, $data->data->CARD, $data->data->BRAND, null,json_encode($data),$data->data->ECI_DESCRIPTION, $data->data->ACTION_DESCRIPTION,$data->data->AMOUNT, $data->data->STATUS );
    }
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

function aumentarCredito($idUsuario, $montoAumento) {
    global $conn;

    // Consulta SQL para aumentar el crédito del usuario
    $sql = "UPDATE usuario SET creditos = creditos + ? WHERE id = ?";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $montoAumento, $idUsuario);
    $stmt->execute();

}
