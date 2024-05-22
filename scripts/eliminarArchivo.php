<?php
include 'conexion.php'; // Asegúrate de que este archivo realiza la conexión a la base de datos.

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $type = $_POST['type']; // 'pdf' o 'image'

    if ($type == 'pdf') {
        $table = 'pdf';
        $id_field = 'id_pdf';
    } else {
        $table = 'archivos';
        $id_field = 'id_archivo';
    }

    // Preparar y ejecutar la consulta para eliminar el archivo
    $stmt = $conn->prepare("DELETE FROM $table WHERE $id_field = ?");
    $stmt->bind_param('i', $id);
    $success = $stmt->execute();

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Archivo eliminado correctamente']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Error al eliminar el archivo']);
    }
} else {
    http_response_code(405); // Método no permitido
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
?>
