<?php
include 'scripts/conexion.php';
include 'scripts/controlSesion.php';

$idActual  = $_SESSION['id'];
$id = $_GET['id'];

echo "El id es $id";

if ($idActual == $_GET['id']) {
    $id = $_GET['id'];
    header("Location: perfilpersonal.php?id=$id");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - Universitat d'Alacant</title>
    <link rel="stylesheet" href="estilos/perfilajeno.css">
    <link rel="stylesheet" href="estilos/nav.css">
    <link rel="stylesheet" href="estilos/styleheader.css">
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
    $sql = "SELECT u.nombre_completo as nombre_autor, t.id_usuario as id_usu, t.id_trabajo, t.fecha_publicacion, t.portada as nombre_archivo , t.titulo as titulo
        FROM trabajos t
        JOIN usuarios u ON t.id_usuario = u.id_usuario
        WHERE u.id_usuario = ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die('Error preparando la consulta: ' . $conn->error);
    }

    // Vincula el parámetro (asumiendo que el ID es un entero)
    $stmt->bind_param('s', $id);

    // Ejecuta la consulta
    $stmt->execute();

    // Obtiene los resultados
    $resultado = $stmt->get_result();

    // Comprueba si se devolvieron filas
    if ($resultado->num_rows > 0) {
        echo '<section class="gallery-container">';
        echo '<section class="project-gallery">';

        while ($row = $resultado->fetch_assoc()) {
            echo '<article>';

            // Enlace alrededor de la imagen que dirige a una URL específica
            echo '<a href="proyecto.php?id=' . $row['id_trabajo'] . '">';
            // Asegúrate de cerrar las comillas correctamente después de src=
            echo '<img src="' . $row['nombre_archivo'] . '" alt="Descripción de la imagen">';
            echo '</a>';
            echo '<p>' . ($row['titulo']) . '</p>';
            echo '<footer>';
            echo '<a href="perfilajeno.php?id=' . $row['id_usu'] . '">';
            echo '<p>' . $row['nombre_autor'] . '</p>';
            echo '</a>';
            echo '<p>' . date('d-m-Y', strtotime($row['fecha_publicacion'])) . '</p>';  // Formateando la fecha
            echo '</footer>';
            echo '</article>';
        }
        echo '</section>';
        echo '<div><button>Ver más</button></div>';
        echo '</section>';
    } else {
        echo "No se encontraron trabajos para el usuario con ID: $id";
    }

    // Cierra el statement
    $stmt->close();

    // Cierra la conexión
    $conn->close();
    ?>
    </section>
    </main>

</body>

</html>