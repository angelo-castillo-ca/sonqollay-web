<?php
include '../../back/coneccion.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Consulta para obtener los módulos
$sql = "SELECT nombre, imagen FROM modulos";
$result = $conn->query($sql);
?>

