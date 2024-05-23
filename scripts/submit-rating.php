<?php
include 'conexion.php';
include 'controlSesion.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    die('No estás autenticado');
}

$id_usuario = $_SESSION['id'];
$id_trabajo = intval($_POST['id_trabajo']);
$valoracion = intval($_POST['estrellas']);

$sql = "INSERT INTO valoraciones (id_usuario, id_trabajo, valoracion) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iii', $id_usuario, $id_trabajo, $valoracion);

if ($stmt->execute()) {
    echo 'Valoración guardada con éxito';
} else {
    echo 'Error al guardar la valoración: ' . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirigir al usuario de vuelta a la página del proyecto
header("Location: ../proyecto.php?id=$id_trabajo");
exit();
?>
