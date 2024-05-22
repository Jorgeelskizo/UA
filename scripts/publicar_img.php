<?php
header('Content-Type: application/json');
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_proyecto'], $_FILES['file'])) {
    $id_proyecto = $_POST['id_proyecto'];
    $altText = $_POST['altText'];

    try {
        $conn->begin_transaction();

        // Extraemos la extensión del nombre original del archivo
        $originalName = $_FILES['file']['name'];
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $baseName = pathinfo($originalName, PATHINFO_FILENAME); // Nombre del archivo sin extensión

        // Insertamos el registro inicial con el nombre del archivo sin extensión
        $sql = "INSERT INTO archivos (id_trabajo, nombre_archivo, nombre, texto_alternativo) VALUES (?, '', ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_proyecto, $baseName, $altText]);
        $archivo_id = $conn->insert_id; // Obtener el ID autogenerado para el archivo

        // Construimos el nuevo nombre del archivo utilizando el ID autogenerado
        $newName = $archivo_id . '.' . $extension;
        $uploadPath = "uploads/" . $newName;

        // Movemos el archivo subido a la nueva ruta
        if (move_uploaded_file($_FILES['file']['tmp_name'], "../" . $uploadPath)) {
            // Actualizamos el registro con el nuevo nombre de archivo
            $updateSql = "UPDATE archivos SET nombre_archivo = ? WHERE id_archivo = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->execute([$uploadPath, $archivo_id]);
            $conn->commit();

            echo json_encode(["success" => true, "message" => "Imagen subida correctamente", "path" => $uploadPath]);
        } else {
            throw new Exception("Failed to move uploaded file.");
        }
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
