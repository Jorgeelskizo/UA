<?php
include 'conexion.php';

// Función para limpiar el nombre del archivo
function cleanFileName($fileName) {
    // Elimina los espacios en blanco al principio y al final
    $fileName = trim($fileName);
    // Reemplaza múltiples espacios o guiones bajos por un solo guión bajo
    $fileName = preg_replace('/[\s_]+/', '_', $fileName);
    // Elimina todos los caracteres no alfanuméricos excepto guiones bajos y puntos
    $fileName = preg_replace('/[^A-Za-z0-9_\-\.]/', '', $fileName);
    return $fileName;
}

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recopilar los datos del formulario
        $nombre_completo = $_POST['nombre_completo'];
        $nick = $_POST['nick'];
        $email = $_POST['correo_electronico'];
        $contrasena = $_POST['contrasena']; // Esto deberá ser hasheado antes de guardar
        
        $fecha = $_POST['fecha'];
        $fecha_formateada = date('Y-m-d', strtotime($fecha));

        $carrera = $_POST['carrera'];
        $anyo = $_POST['anyo'];

        // Hashear la contraseña
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

        // Procesar la carga del archivo de foto
        $foto_path = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $foto_name = cleanFileName(basename($_FILES['foto']['name']));
            $foto_path = "uploads/" . uniqid() . "_" . $foto_name; // Asegura que el nombre del archivo sea único
            
            // Depuración: Verificar el nombre del archivo temporal y la ruta de destino
            echo "Archivo temporal: " . $_FILES['foto']['tmp_name'] . "<br>";
            echo "Ruta de destino: " . $foto_path . "<br>";

            // Mover el archivo a la carpeta de destino
            if (move_uploaded_file($_FILES['foto']['tmp_name'], "../" . $foto_path)) {
                echo "Archivo movido correctamente<br>";
            } else {
                echo "Error al mover el archivo<br>";
                $foto_path = null;
            }
        } else {
            echo "No se ha seleccionado ningún archivo o hubo un error en la subida.<br>";
        }

        // Preparar la sentencia SQL para insertar los datos
        $sql = "INSERT INTO usuarios (nombre_completo, nick, carrera, anyo, foto, contrasena, correo_electronico, fecha) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssissss', $nombre_completo, $nick, $carrera, $anyo, $foto_path, $hashed_password, $email, $fecha_formateada);

        if ($stmt->execute()) {
            session_start();
            $_SESSION['nombre_usuario'] = $nombre_completo;
            $_SESSION['foto'] = $foto_path;

            if(isset($_SESSION['nombre_usuario'])){
                $username = $_SESSION['nombre_usuario'];
             // Preparar la consulta para obtener solo el nombre de usuario y la contraseña hasheada
                $query = "SELECT nombre_completo, carrera,  contrasena, id_usuario, foto FROM usuarios WHERE nombre_completo = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();
            
            
                if ($user = $result->fetch_assoc()) {
                    // Verificar si la contraseña coincide

                        $_SESSION['id'] = $user['id_usuario'];
                        $_SESSION['carrera'] = $user['carrera'];
                        $_SESSION['lang'] = 'es';
                        $_SESSION['modo'] = '';
            
                        $mensaje = "Entrado";
                        echo $_SESSION['id'];
                        // Emitir un script JavaScript para que se ejecute en el navegador
                        echo "<script>console.log('". addslashes($mensaje) ."');</script>";
                
                        // Redirige al usuario a la página principal
                        header("Location: index.php");
            
                } else {
                    // Usuario no encontrado
                    $error = "Usuario o contraseña incorrectos.";
                }
            }
            echo "Usuario registrado correctamente!";

            header("Location: ../index.php");
            exit();
        } else {
            echo "Error al registrar el usuario: " . $stmt->error . "<br>";
        }

        $stmt->close();
    }
} catch (PDOException $e) {
    // Capturar y mostrar el error en caso de fallo en la conexión o en la consulta
    echo "Error: " . $e->getMessage() . "<br>";
}
?>
