<?php
session_start();
$_SESSION['lang'] = $_GET['l'] ?? 'in';

echo $_SESSION['lang'];

// Redirigir de vuelta a la página principal o donde necesites
header("Location: ../configuracion.php");  // Cambia 'index.php' a la página a la que deseas volver
?>