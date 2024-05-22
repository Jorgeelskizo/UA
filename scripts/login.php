<?php
session_start();
include 'conexion.php';

// Comprobar si el usuario ya está logueado

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['nombre_completo'];
    $contrasena = $_POST['contrasena'];
    $recordar = $_POST['recordar'];

    $usuario_valido = false;
    $estilo_usuario = '';

    // Preparar la consulta para obtener solo el nombre de usuario y la contraseña hasheada
    $query = "SELECT nombre_completo, contrasena,id_usuario, foto FROM usuarios WHERE nombre_completo = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Verificar si la contraseña coincide
       
        if (password_verify($contrasena, $user['contrasena'])) {
            // Si las credenciales son correctas, establece las variables de sesión
            $_SESSION['nombre_usuario'] = $user['nombre_completo'];
            $_SESSION['foto'] = $user['foto'];
            $_SESSION['id'] = $user['id_usuario'];
            $_SESSION['lang'] = 'es';
            $_SESSION['modo'] = '';


            if (isset($_POST['recordar'])) {

                $fecha_fin = time() + 60 * 60 * 24 * 90;
                $cookie_value = base64_encode($usuario . "|" . $contrasena . "|" . $fecha_fin);
    
                setcookie('recordarme', $cookie_value, time() + 60 * 60 * 24 * 90, '/');

            }
            // Redirige al usuario a la página principal
            if(isset($_SESSION['nombre_usuario'])){
                header("Location: ../index.php");
            }
            
        } else {
            // Contraseña incorrecta
            $error = "Usuario o contraseña incorrectos.";
        }
    } else {
        // Usuario no encontrado
        $error = "Usuario o contraseña incorrectos.";
    }
}