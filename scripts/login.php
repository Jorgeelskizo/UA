<?php

$host = 'localhost';
$dbname = 'ua';
$username = 'root';
$password = 'root1'; // Asegúrate de configurar tu contraseña real de la base de datos aquí

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Comprobar si el usuario ya está logueado


// Asumiendo que este formulario enviará 'username' y 'password' para la autenticación
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['nombre_completo'];
    $password = $_POST['contrasena'];
    $recordar = isset($_POST['recordar']) ? $_POST['recordar'] : '';

    // Preparar la consulta para obtener solo el nombre de usuario y la contraseña hasheada
    $query = "SELECT nombre_completo, contrasena FROM usuarios WHERE nombre_completo = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Verificar si la contraseña coincide
        if (password_verify($password, $user['contrasena'])) {
            // Si las credenciales son correctas, establece las variables de sesión
            $_SESSION['nombre_usuario'] = $user['nombre_completo'];

            // Redirige al usuario a la página principal
            header("Location: ../index.php");
            exit();
        } else {
            // Contraseña incorrecta
            $error = "Usuario o contraseña incorrectos.";
        }
    } else {
        // Usuario no encontrado
        $error = "Usuario o contraseña incorrectos.";
    }
}
