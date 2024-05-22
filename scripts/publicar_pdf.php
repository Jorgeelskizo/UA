<?php
header('Content-Type: application/json');
include 'conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_proyecto'])) {
    $id_proyecto = $_POST['id_proyecto'];
    try {
        $conn->begin_transaction();

        foreach ($_FILES['pdfFiles']['tmp_name'] as $index => $tmpName) {
            $originalName = $_FILES['pdfFiles']['name'][$index];
            $title = $_POST['pdfTitles'][$index];
            $description = $_POST['pdfDescriptions'][$index] ?: 'Sin descripción';

            // Insertar inicialmente sin la ruta
            $sql = "INSERT INTO pdf (id_proyecto, nombre, titulo, descripcion, ruta) VALUES (?, ?, ?, ?, '')";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_proyecto, $originalName, $title, $description]);
            $pdf_id = $conn->insert_id; // Obtener el ID autogenerado para el PDF

            // Construir la nueva ruta utilizando el ID autogenerado
            $newName = $pdf_id . '.pdf';
            $uploadPath = "uploads_pdf/" . $newName;

            if (move_uploaded_file($tmpName, "../" . $uploadPath)) {
                // Actualizar la ruta en la base de datos
                $updateSql = "UPDATE pdf SET ruta = ? WHERE id_pdf = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->execute([$uploadPath, $pdf_id]);
            }
        }

        $conn->commit();
        echo json_encode(["success" => true, "message" => "PDFs subidos correctamente"]);
    } catch (Exception $e) {
        $conn->rollback();
        http_response_code(500);
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(["success" => false, "error" => "Método no permitido o falta ID de proyecto"]);
}
?>
