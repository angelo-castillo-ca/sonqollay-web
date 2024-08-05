<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['cantidad'])) {
    $cantidad = intval($data['cantidad']);
    // Verificar que la cantidad sea válida
    if ($cantidad > 0) {
        // Sumar la cantidad de monedas al saldo del usuario
        if (isset($_SESSION['creditos'])) {
            $_SESSION['creditos'] += $cantidad;
        } else {
            $_SESSION['creditos'] = $cantidad;
        }
        echo json_encode(['success' => true, 'creditos' => $_SESSION['creditos']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Cantidad inválida']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Cantidad no especificada']);
}
?>
