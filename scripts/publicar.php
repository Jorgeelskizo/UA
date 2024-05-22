<?php
header('Content-Type: application/json');
include 'conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $conn->autocommit(FALSE);
        $conn->begin_transaction();

        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $horas = $_POST['horas'];
        $tipo = $_POST['tipo'];
        $id_usuario = $_SESSION['id'];
        $fecha_publicacion = date('Y-m-d H:i:s');

        $portada_path = "uploads/" . basename($_FILES['portada']['name']);
        move_uploaded_file($_FILES['portada']['tmp_name'], "../" . $portada_path);

        $sql = "INSERT INTO trabajos (titulo, id_usuario, horas, descripcion, fecha_publicacion, portada, tipo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$titulo, $id_usuario, $horas, $descripcion, $fecha_publicacion, $portada_path, $tipo]);
        $id_proyecto = $conn->insert_id;

        $conn->commit();
        echo json_encode(["success" => true, "message" => "Trabajo registrado correctamente!", "id_proyecto" => $id_proyecto]);
    } catch (Exception $e) {
        $conn->rollback();
        http_response_code(500);
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(["success" => false, "error" => "Método no permitido"]);
}
?>
