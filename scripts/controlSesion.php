<?php

$host = 'localhost';
$dbname = 'ua';
$username = 'root';
$password = 'root1'; // Asegúrate de configurar tu contraseña real de la base de datos aquí

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pagina_actual = basename($_SERVER['PHP_SELF']);


if(isset($_COOKIE['recordarme']) && !isset($_SESSION['nombre_usuario']) ){
    
    
    //Recuperar datos de la cookie
    $credentials = base64_decode($_COOKIE['recordarme']);
    list($username, $password, $fecha_fin) = explode('|', $credentials);

    $usuario_valido = false;
    $estilo_usuario = '';

    // Preparar la consulta para obtener solo el nombre de usuario y la contraseña hasheada
    $query = "SELECT nombre_completo, contrasena, foto FROM usuarios WHERE nombre_completo = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Verificar si la contraseña coincide
        if (password_verify($password, $user['contrasena'])) {
            // Si las credenciales son correctas, establece las variables de sesión
            $_SESSION['nombre_usuario'] = $user['nombre_completo'];
            $_SESSION['foto'] = $user['foto'];

            $mensaje = "Entrado";

            // Emitir un script JavaScript para que se ejecute en el navegador
            echo "<script>console.log('". addslashes($mensaje) ."');</script>";
    
            // Redirige al usuario a la página principal
            header("Location: index.php");

        } else {
            // Contraseña incorrecta
            $error = "Usuario o contraseña incorrectos.";
        }
    } else {
        // Usuario no encontrado
        $error = "Usuario o contraseña incorrectos.";
    }
}

?>