<?php 
session_start();

include 'scripts/controlSesion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universitat d'Alacant</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="styleheader.css">
</head>

<body>

    <?php
    include 'Imports/header.php';
    ?>

    <div class="header-image"></div>

    <?php
    include 'Imports/barranav.php';
    ?>


    <?php
    // Conexión a la base de datos
    $host = '127.0.0.1';
    $dbname = 'ua';
    $user = 'wordpress';
    $password = 'wordpress';
    $conexion = new mysqli($host, $user, $password, $dbname);

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Consulta para obtener los datos de los trabajos y sus imágenes
    $sql = "SELECT u.nombre_completo as nombre_autor, t.fecha_publicacion, t.portada as nombre_archivo
        FROM trabajos t
        JOIN usuarios u ON t.id_usuario = u.id_usuario";


    $resultado = $conexion->query($sql);

    // Comprobando si la consulta devolvió filas
    if ($resultado->num_rows > 0) {
        echo '<section class="gallery-container">';
        echo '<section class="project-gallery">';

        // Procesando cada fila del resultado
        while ($row = $resultado->fetch_assoc()) {
            echo '<article>';
            // Asegúrate de cerrar las comillas correctamente después de src=
            echo '<img src=' . $row['nombre_archivo'] . ' alt= " ">';

            echo '<footer>';
            echo '<p>' . $row['nombre_autor'] . '</p>';
            echo '<p>' . date('d-m-Y', strtotime($row['fecha_publicacion'])) . '</p>';  // Formateando la fecha
            echo '</footer>';
            echo '</article>';
        }


        echo '</section>';
        echo '<div><button>Ver más</button></div>';
        echo '</section>';
    } else {
        echo "0 resultados";
    }

    // Cerrar la conexión
    $conexion->close();
    ?>

</body>

</html>