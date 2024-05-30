<?php
include 'scripts/conexion.php';
include 'scripts/controlSesion.php';
include 'scripts/seleccionarIdioma.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universitat d'Alacant</title>
    <link rel="stylesheet" href="estilos/unificado.css">
    <link rel="stylesheet" href="imports/fontello/css/fontello.css">
    <?php include 'scripts/controlEstilo.php'; ?>
    <?php include 'scripts/controlTamano.php'; ?>
</head>
<script>
function cargarMas() {
    var limit = 999; // Puedes ajustar este número según cuántos elementos quieres cargar

    // Construir la URL con el nuevo límite
    var url = window.location.href.split('?')[0] + '?limit=' + limit;

    // Uso de AJAX para cargar los datos
    fetch(url)
    .then(response => response.text())
    .then(html => {
        var parser = new DOMParser();
        var doc = parser.parseFromString(html, "text/html");
        var newContent = doc.querySelector('.project-gallery-index').innerHTML;
        document.querySelector('.project-gallery-index').innerHTML = newContent;
    })
    .catch(error => console.error('Error al cargar más artículos:', error));
}
</script>

<body>

    <?php
    include 'Imports/header.php';
    ?>

    <div class="header-image-index"></div>

    <?php
    include 'Imports/barranav.php';
    ?>


    <?php
    // Consulta para obtener los datos de los trabajos y sus imágenes
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 4;  // Default a 4

    $sql = "SELECT u.nombre_completo as nombre_autor, t.id_usuario as id_usu, t.id_trabajo, t.fecha_publicacion, t.portada as nombre_archivo, t.titulo as titulo
        FROM trabajos t
        JOIN usuarios u ON t.id_usuario = u.id_usuario
        LIMIT $limit";

    $resultado = $conn->query($sql);

    // Comprobando si la consulta devolvió filas
    if ($resultado->num_rows > 0) {
        echo '<section class="gallery-container-index">';
        echo '<section class="project-gallery-index">';

        // Procesando cada fila del resultado
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
        echo '<div><button onclick="cargarMas()">' . $palabras['vermas'] . '</button></div>';
        echo '</section>';
    } else {
        echo "0 resultados";
    }

    // Cerrar la conexión
    $conn->close();
    ?>

</body>


</html>