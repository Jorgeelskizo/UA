<?php
include 'scripts/conexion.php';
include 'scripts/controlSesion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'] ?? '';
    $fecha_publicacion = $_POST['fecha_publicacion'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $anyo = $_POST['anyo'] ?? '';
    $valoracion = $_POST['valoracion'] ?? '';

    $query = "SELECT * FROM trabajos WHERE 1=1";
    if (!empty($titulo)) {
        $query .= " AND titulo LIKE '%" . $titulo . "%'";
    }
    if (!empty($fecha_publicacion)) {
        $query .= " AND fecha_publicacion = '" . $fecha_publicacion . "'";
    }
    if (!empty($tipo)) {
        $query .= " AND tipo = '" . $tipo . "'";
    }
    if (!empty($anyo)) {
        $query .= " AND anyo = " . $anyo;
    }
    if (!empty($valoracion)) {
        $query .= " AND valoracion >= " . $valoracion;
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
    <link rel="stylesheet" href="estilos/index.css">
    <link rel="stylesheet" href="estilos/buscar.css">
    <link rel="stylesheet" href="estilos/nav.css">
    <link rel="stylesheet" href="estilos/styleheader.css">
</head>

<body>
    <?php include 'Imports/header.php'; ?>
    <div class="header-image"></div>
    <?php include 'Imports/barranav.php'; ?>

    <form id="searchForm" class="search-container" method="POST" enctype="multipart/form-data">
        <input type="text" name="titulo" placeholder="Título" class="search-input">
        <input type="date" name="fecha_publicacion" class="search-select">
        <select name="tipo" class="search-select">
            <option disabled selected>Tipo</option>
            <option value="tfg">TFG</option>
            <option value="tfm">TFM</option>
            <option value="practicas">Practicas</option>
            <option value="proyectos">Proyectos</option>
        </select>
        <select name="anyo" class="search-select">
            <option disabled selected>Año</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <input type="number" name="valoracion" placeholder="Valoración" class="search-select">
        <button type="submit" class="search-button">Buscar</button>
    </form>

    <div id="results">
        <?php
        if (isset($result) && $result->num_rows > 0) {
            echo '<section class="gallery-container">';
            echo '<section class="project-gallery">';
            while($row = $result->fetch_assoc()) {
                echo '<article>';
                echo '<a href="proyecto.php">';
                echo '<img src="' . $row['portada'] . '" alt="Descripción de la imagen">';
                echo '</a>';
                echo '<p>' . ($row['titulo']) . '</p>';
                echo '<footer>';
                echo '<p>' . $row['fecha_publicacion'] . '</p>'; // Formatea la fecha si es necesario
                echo '</footer>';
                echo '</article>';
            }
            echo '</section>';
            echo '</section>';
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "No se encontraron resultados.";
        }
        ?>
    </div>

</body>

</html>
