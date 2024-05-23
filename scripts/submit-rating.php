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

// Verificar si ya existe una valoración para este usuario y proyecto
$sql = "SELECT id_valoracion FROM valoraciones WHERE id_usuario = ? AND id_trabajo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $id_usuario, $id_trabajo);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Si ya existe una valoración, actualizarla
    $stmt->bind_result($id_valoracion);
    $stmt->fetch();
    $stmt->close();

    $sql = "UPDATE valoraciones SET valoracion = ? WHERE id_valoracion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $valoracion, $id_valoracion);

    if ($stmt->execute()) {
        echo 'Valoración actualizada con éxito';
    } else {
        echo 'Error al actualizar la valoración: ' . $stmt->error;
    }
} else {
    // Si no existe una valoración, insertar una nueva
    $stmt->close();

    $sql = "INSERT INTO valoraciones (id_usuario, id_trabajo, valoracion) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $id_usuario, $id_trabajo, $valoracion);

    if ($stmt->execute()) {
        echo 'Valoración guardada con éxito';
    } else {
        echo 'Error al guardar la valoración: ' . $stmt->error;
    }
}

$stmt->close();
$conn->close();

// Redirigir al usuario de vuelta a la página del proyecto
header("Location: ../proyecto.php?id=$id_trabajo");
exit();
?>
