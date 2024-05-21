<?php
session_start();
include 'conexion.php';

// Verifica si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    die('No estás autenticado');
}

$id_usuario = $_SESSION['id'];

echo $id_usuario;
$id_trabajo = isset($_POST['id_trabajo']) ? intval($_POST['id_trabajo']) : 0;
$titulo = isset($_POST['titulo']) ? intval($_POST['titulo']) : '';
$comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';

if ($id_trabajo > 0 && !empty($comentario)) {
    $fecha_publicacion = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO comentarios (id_usuario, id_trabajo, titulo, descripcion, fecha_publicacion) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('iisss', $id_usuario, $id_trabajo, $titulo, $comentario, $fecha_publicacion);

    if ($stmt->execute()) {
        echo 'Comentario subido con éxito';
    } else {
        echo 'Error al subir el comentario: ' . $stmt->error;
    }

    $stmt->close();
} else {
    echo 'Todos los campos son obligatorios';
}

$conn->close();
header("Location: ../proyecto.php?id=$id_trabajo");
exit();
?>
