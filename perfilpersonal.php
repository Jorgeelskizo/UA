<?php
    include 'scripts/auth.php';

    $nombre = $_SESSION['nombre_usuario'];
?>



<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Perfil de Usuario - Universitat d'Alacant</title>
<link rel="stylesheet" href="estilos/unificado.css">
</head>
<body>

<?php
    include 'Imports/header.php';
?>

<?php
    include 'Imports/statsperfil.php';
?>

  <?php
    include 'Imports/barranav.php';
  ?>


<?php
    include 'scripts/conexion.php';

    // Consulta para obtener los datos de los trabajos y sus imágenes
    $sql = "SELECT u.nombre_completo as nombre_autor, t.fecha_publicacion, t.portada as nombre_archivo
        FROM trabajos t
        JOIN usuarios u ON t.id_usuario = u.id_usuario
        WHERE u.nombre_completo = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $result = $stmt->get_result();

    // Comprobando si la consulta devolvió filas
    if ($result->num_rows > 0) {
        echo '<section class="gallery-container-index">';
        echo '<section class="project-gallery-index">';

        // Procesando cada fila del resultado
        while ($row = $result->fetch_assoc()) {
            echo '<article>';
            // Asegúrate de cerrar las comillas correctamente después de src=
            echo '<img src=' . $row['nombre_archivo'] . ' alt=" ">';

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
    $conn->close();
    ?>
</main>

</body>
</html>
