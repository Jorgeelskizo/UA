<?php
header('Content-Type: application/json');
include 'conexion.php';
session_start();

$id_trabajo = $_POST['id_trabajo'] ?? null;
$titulo = $_POST['titulo'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$horas = $_POST['horas'] ?? 0;
$tipo = $_POST['tipo'] ?? '';
$portada_actual = $_POST['portada_actual'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $id_trabajo) {
    try {
        $conn->begin_transaction();
        $sql = "UPDATE trabajos SET titulo=?, descripcion=?, horas=?, tipo=? WHERE id_trabajo=?";
        $params = [$titulo, $descripcion, $horas, $tipo, $id_trabajo];
        if (isset($_FILES['portada']) && $_FILES['portada']['error'] == 0) {
            $portada_path = "uploads/" . basename($_FILES['portada']['name']);
            move_uploaded_file($_FILES['portada']['tmp_name'], "../" . $portada_path);
            $sql = "UPDATE trabajos SET titulo=?, descripcion=?, horas=?, tipo=?, portada=? WHERE id_trabajo=?";
            array_splice($params, 4, 0, $portada_path);  // Inserta la portada en los parámetros
        }
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $conn->commit();
        echo json_encode(["success" => true, "message" => "Proyecto actualizado correctamente!"]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Método no permitido o falta de información"]);
}
?>
