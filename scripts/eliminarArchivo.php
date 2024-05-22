<?php
include 'conexion.php';  // Asegúrate de que este archivo no genera salida

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'], $_POST['type'])) {
    $id = $_POST['id'];
    $type = $_POST['type'];

    // Determina la tabla y el campo ID basado en el tipo
    $table = ($type === 'pdf') ? 'pdf' : 'archivos';
    $id_field = ($type === 'pdf') ? 'id_pdf' : 'id_archivo';

    $sql = "DELETE FROM $table WHERE $id_field = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$id])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No se pudo eliminar el archivo']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Datos insuficientes']);
}
?>
