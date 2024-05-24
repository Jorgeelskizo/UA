<?php
session_start();
include 'conexion.php';

// Comprobar si el usuario ya está logueado

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['nombre_completo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    $recordar = isset($_POST['recordar']) ? true : false;

    $stmt = $conn->prepare("SELECT nombre_completo, contrasena, id_usuario, foto FROM usuarios WHERE nombre_completo = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($contrasena, $user['contrasena'])) {
            $_SESSION['nombre_usuario'] = $user['nombre_completo'];
            $_SESSION['foto'] = $user['foto'];
            $_SESSION['id'] = $user['id_usuario'];
            $_SESSION['lang'] = 'es';
            $_SESSION['modo'] = '';
            $_SESSION['tam'] = '1';

            if ($recordar) {
                $fecha_fin = time() + 60 * 60 * 24 * 90;
                $cookie_value = base64_encode($usuario . "|" . $contrasena . "|" . $fecha_fin);
                setcookie('recordarme', $cookie_value, time() + 60 * 60 * 24 * 90, '/');
            }
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['error'] = "Usuario o contraseña incorrectos.";
            header("Location: ../login-form.php"); // Asegúrate de redirigir a la página correcta
            exit();
        }
    } else {
        $_SESSION['error'] = "Usuario o contraseña incorrectos.";
        header("Location: ../login-form.php"); // Asegúrate de redirigir a la página correcta
        exit();
    }
    $conn->close();
}
?>