<?php
header('Content-Type: application/json');
include 'conexion.php';

// Recuperar el ID del proyecto desde la URL
$id_proyecto = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_proyecto == 0) {
    echo json_encode(["error" => "ID de proyecto no especificado"]);
    exit;
}

// Preparamos y ejecutamos la consulta para obtener los PDFs asociados
$stmt = $conn->prepare("SELECT id_pdf, titulo, descripcion, ruta FROM pdf WHERE id_proyecto = ?");
$stmt->bind_param("i", $id_proyecto);
$stmt->execute();
$result = $stmt->get_result();

$pdfs = [];
while ($pdf = $result->fetch_assoc()) {
    $pdfs[] = $pdf;
}

// Devolver los datos en formato JSON
echo json_encode($pdfs);
?>
