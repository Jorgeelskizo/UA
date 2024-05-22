<?php
header('Content-Type: application/json');
include 'scripts/conexion.php';
include 'scripts/controlSesion.php';

$id_trabajo = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id_trabajo == 0) {
    echo json_encode(["error" => "ID de trabajo no especificado o inválido."]);
    exit;
}

$stmt = $conn->prepare("SELECT titulo, descripcion, portada, horas, tipo FROM trabajos WHERE id_trabajo = ?");
$stmt->bind_param("i", $id_trabajo);
$stmt->execute();
$result = $stmt->get_result();

if ($trabajo = $result->fetch_assoc()) {
    echo json_encode($trabajo);
} else {
    echo json_encode(["error" => "Trabajo no encontrado."]);
}
?>
