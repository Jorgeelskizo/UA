<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';
$dbname = 'ua';
$username = 'root';
$password = ''; // Asegúrate de configurar tu contraseña real de la base de datos aquí

// Intentar la conexión con la base de datos
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si el método de solicitud es POST
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
            $foto_name = basename($_FILES['foto']['name']);
            $foto_path = "uploads/" . $foto_name;
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], "../" . $foto_path)) {
                $foto_path = null;
            }
        }

        // Preparar la sentencia SQL para insertar los datos
        $sql = "INSERT INTO usuarios (nombre_completo, nick, carrera, anyo, foto, contrasena, correo_electronico, fecha) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre_completo, $nick, $carrera, $anyo, $foto_path, $hashed_password, $email, $fecha_formateada]);

        echo "Usuario registrado correctamente!";
    }
} catch (PDOException $e) {
    // Capturar y mostrar el error en caso de fallo en la conexión o en la consulta
    echo "Error: " . $e->getMessage();
}
?>