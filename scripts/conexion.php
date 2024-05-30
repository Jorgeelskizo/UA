<?php
$host = 'localhost';
$dbname = 'ua';
$username = 'UA';
$password = 'UA'; // Asegúrate de configurar tu contraseña real de la base de datos aquí

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>