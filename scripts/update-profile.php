<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['id'])) {
    die('No estás autenticado');
}

$id_usuario = $_SESSION['id'];

// Obtener los valores actuales del perfil del usuario
$sql = "SELECT nombre_completo, nick, carrera FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$stmt->bind_result($current_user_name, $current_username, $current_degree);
$stmt->fetch();
$stmt->close();

// Obtener los valores enviados por el formulario
$user_name = isset($_POST['user-name']) ? trim($_POST['user-name']) : '';
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$degree = isset($_POST['degree']) ? trim($_POST['degree']) : '';

// Usar los valores actuales si los campos del formulario están vacíos
$user_name = !empty($user_name) ? $user_name : $current_user_name;
$username = !empty($username) ? $username : $current_username;
$degree = !empty($degree) ? $degree : $current_degree;

// Actualizar los valores en la base de datos
$stmt = $conn->prepare("UPDATE usuarios SET nombre_completo = ?, nick = ?, carrera = ? WHERE id_usuario = ?");
$stmt->bind_param('sssi', $user_name, $username, $degree, $id_usuario);

if ($stmt->execute()) {
    echo 'Perfil actualizado con éxito';
    $_SESSION['nombre_usuario'] = $user_name;
} else {
    echo 'Error al actualizar el perfil: ' . $stmt->error;
}

$stmt->close();
$conn->close();
header("Location: ../editarPerfil.php");
exit();
?>
