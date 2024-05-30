<?php
include 'scripts/conexion.php';
include 'scripts/controlSesion.php';

$result = null;  // Inicializa la variable $result

if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_GET['search']) || isset($_GET['populares']) || isset($_GET['tipo'])) {
    $titulo = $_POST['titulo'] ?? ($_GET['search'] ?? '');
    $fecha_publicacion = $_POST['fecha_publicacion'] ?? '';
    $tipo = $_POST['tipo'] ?? ($_GET['tipo'] ?? '');
    $anyo = $_POST['anyo'] ?? '';
    $valoracion = $_POST['valoracion'] ?? '';
    $populares = isset($_GET['populares']) ? true : false;

    $query = "SELECT u.nombre_completo as nombre_autor, t.id_usuario as id_usu, t.id_trabajo, t.fecha_publicacion, t.portada as nombre_archivo, t.titulo as titulo
              FROM trabajos t
              JOIN usuarios u ON t.id_usuario = u.id_usuario
              WHERE 1=1";

    if (!empty($titulo)) {
        $titulo_escapado = $conn->real_escape_string($titulo);
        $query .= " AND (t.titulo LIKE '%$titulo_escapado%' OR u.nick LIKE '%$titulo_escapado%' OR u.nombre_completo LIKE '%$titulo_escapado%')";
    }
    if (!empty($fecha_publicacion)) {
        $query .= " AND t.fecha_publicacion = '" . $conn->real_escape_string($fecha_publicacion) . "'";
    }
    if (!empty($tipo)) {
        $query .= " AND t.tipo = '" . $conn->real_escape_string($tipo) . "'";
    }
    if (!empty($anyo)) {
        $query .= " AND t.anyo = " . intval($anyo);
    }
    if (!empty($valoracion)) {
        $query .= " AND t.valoracion = " . intval($valoracion);
    }
    if ($populares) {
        $query .= " AND t.valoracion = 5";
    }

    $result = $conn->query($query);
}
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

<body>
    <?php include 'Imports/header.php'; ?>
    <div class="header-image-index"></div>
    <?php include 'Imports/barranav.php'; ?>

    <form id="searchForm" class="search-container-buscar" method="POST" enctype="multipart/form-data">
        <input type="text" name="titulo" placeholder="Título o Nick" class="search-input-buscar">
        <input type="date" name="fecha_publicacion" class="search-select-buscar">
        <select name="tipo" class="search-select-buscar">
            <option disabled selected>Tipo</option>
            <option value="tfg">TFG</option>
            <option value="tfm">TFM</option>
            <option value="practicas">Practicas</option>
            <option value="proyectos">Proyectos</option>
        </select>
        <select name="anyo" class="search-select-buscar">
            <option disabled selected>Año</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <input type="number" name="valoracion" placeholder="Valoración" class="search-select-buscar">
        <button type="submit" class="search-button-buscar">Buscar</button>
    </form>

    <div id="results">
        <?php
        if (isset($result) && $result->num_rows > 0) {
            echo '<section class="gallery-container-index">';
            echo '<section class="project-gallery-index">';
            while ($row = $result->fetch_assoc()) {
                echo '<article>';

                // Enlace alrededor de la imagen que dirige a una URL específica
                echo '<a href="proyecto.php?id=' . $row['id_trabajo'] . '">';
                // Asegúrate de cerrar las comillas correctamente después de src=
                echo '<img src="' . $row['nombre_archivo'] . '" alt="Descripción de la imagen">';
                echo '</a>';
                echo '<p>' . htmlspecialchars($row['titulo']) . '</p>';
                echo '<footer>';
                echo '<a href="perfilajeno.php?id=' . $row['id_usu'] . '">';
                echo '<p>' . htmlspecialchars($row['nombre_autor']) . '</p>';
                echo '</a>';
                echo '<p>' . date('d-m-Y', strtotime($row['fecha_publicacion'])) . '</p>';  // Formateando la fecha
                echo '</footer>';
                echo '</article>';
            }
            echo '</section>';
            echo '</section>';
        } else if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_GET['search']) || isset($_GET['populares']) || isset($_GET['tipo'])) {
            echo "No se encontraron resultados.";
        }
        ?>
    </div>

</body>

</html>
