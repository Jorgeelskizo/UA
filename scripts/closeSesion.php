<?php
session_start(); // Iniciar la sesión para acceder a las variables de sesión
setcookie('recordarme', '', time() - 3600, '/');

session_destroy(); // Destruir todas las variables de sesión
header('Location: ../index.php'); // Redirigir al usuario a la página de inicio u otra página
exit();
?>