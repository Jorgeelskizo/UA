<?php
session_start();
include 'conexion.php';

$response = ['status' => 'error', 'message' => 'Algo salió mal'];

try {
    // Verifica si el usuario está autenticado
    if (!isset($_SESSION['id'])) {
        throw new Exception('No estás autenticado');
    }

    $id_usuario = $_SESSION['id'];
    $id_trabajo = isset($_POST['id_trabajo']) ? intval($_POST['id_trabajo']) : 0;

    // Verifica si el proyecto existe y si el usuario es el creador
    $sql = "SELECT id_usuario FROM trabajos WHERE id_trabajo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_trabajo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($trabajo = $result->fetch_assoc()) {
        if ($trabajo['id_usuario'] !== $id_usuario) {
            throw new Exception('No tienes permisos para eliminar este proyecto');
        }
    } else {
        throw new Exception('Proyecto no encontrado');
    }

    // Eliminar el proyecto de la base de datos
    $stmt = $conn->prepare("DELETE FROM trabajos WHERE id_trabajo = ?");
    $stmt->bind_param('i', $id_trabajo);

    if (!$stmt->execute()) {
        throw new Exception('Error al eliminar el proyecto: ' . $stmt->error);
    }

    $response['status'] = 'success';
    $response['message'] = 'Proyecto eliminado correctamente';

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

$conn->close();
header("Location: ../index.php");
exit();
?>