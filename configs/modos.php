<?php
session_start();
$_SESSION['modo'] = $_GET['m'] ?? '';

echo $_SESSION['modo'];

// Redirigir de vuelta a la página principal o donde necesites
header("Location: ../configuracion.php");  // Cambia 'index.php' a la página a la que deseas volver
?>