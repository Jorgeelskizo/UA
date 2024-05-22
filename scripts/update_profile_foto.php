<?php
session_start();
include 'conexion.php';
include 'controlSesion.php';

if (!isset($_SESSION['id'])) {
    die('No estás autenticado');
}

$id_usuario = $_SESSION['id'];

function cleanFileName($fileName) {
    // Elimina los espacios en blanco al principio y al final
    $fileName = trim($fileName);
    // Reemplaza múltiples espacios o guiones bajos por un solo guión bajo
    $fileName = preg_replace('/[\s_]+/', '_', $fileName);
    // Elimina todos los caracteres no alfanuméricos excepto guiones bajos y puntos
    $fileName = preg_replace('/[^A-Za-z0-9_\-\.]/', '', $fileName);
    return $fileName;
}

if (isset($_FILES['profile-photo']) && $_FILES['profile-photo']['error'] == 0) {
    $foto_name = cleanFileName(basename($_FILES['profile-photo']['name']));
    $target_dir = "uploads/";
    $target_file = $target_dir . $foto_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verifica el tamaño del archivo
    if ($_FILES["profile-photo"]["size"] > 20000000) {
        die("Lo siento, tu archivo es demasiado grande.");
    }

    // Permitir ciertos formatos de archivo
    $allowed_types = ['jpg', 'jpeg', 'png'];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Lo siento, solo se permiten archivos JPG, JPEG y PNG.");
    }

    if (move_uploaded_file($_FILES["profile-photo"]["tmp_name"], "../" . $target_file)) {
        $stmt = $conn->prepare("UPDATE usuarios SET foto = ? WHERE id_usuario = ?");
        $stmt->bind_param('si', $target_file, $id_usuario);

        if ($stmt->execute()) {
            echo "La foto de perfil ha sido actualizada.";
            $_SESSION['foto'] = $target_file;
        } else {
            echo "Error al actualizar la foto de perfil: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Lo siento, hubo un error al subir tu archivo.";
    }
} else {
    echo "No se ha seleccionado ningún archivo o hubo un error en la subida.";
}

$conn->close();
header("Location: ../editarPerfil.php");
exit();
?>
