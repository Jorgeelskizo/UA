<?php
session_start();

// Comprobar si la variable de sesión 'usuario_id' está establecida
if (!isset($_SESSION['nombre_usuario'])) {
    // Si no está establecida, redirigir a la página de login
    header("Location: login.html");
    exit(); // Asegúrate de no ejecutar código adicional después de la redirección
}
?>