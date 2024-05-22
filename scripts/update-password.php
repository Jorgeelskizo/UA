<?php
session_start();
include 'conexion.php';
include 'controlSesion.php';

if (!isset($_SESSION['id'])) {
    die('No estás autenticado');
}

$id_usuario = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['new-password'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Asegúrate de tener una variable de sesión de usuario, como user_id
    if (isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];

        // Actualizar la contraseña en la base de datos
        $sql = "UPDATE usuarios SET contrasena = ? WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('si', $hashedPassword, $userId);
            $stmt->execute();
            if ($stmt->affected_rows === 1) {
                header("Location: ../editarPerfil.php?success=Contraseña actualizada correctamente");
            } else {
                header("Location: ../editarPerfil.php?error=Error al actualizar la contraseña");
            }
            $stmt->close();
        } else {
            header("Location: ../editarPerfil.php?error=Error en la preparación de la consulta");
        }
    } else {
        header("Location: ../editarPerfil.php?error=Usuario no autenticado");
    }

    $conn->close();
}
?>
