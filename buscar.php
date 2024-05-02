<?php
include 'scripts/conexion.php';
include 'scripts/controlSesion.php';
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
    <?php include 'Imports/barranav.php'; ?>

    <form id="searchForm" class="search-container">
        <input type="text" name="nombre_proyecto" placeholder="Nombre del Proyecto" class="search-input">
        <input type="date" name="fecha" class="search-select">
        <select name="tipo" class="search-select">
            <option disabled selected>Tipo</option>
            <option value="tfg">TFG</option>
            <option value="tfm">TFM</option>
        </select>
        <select name="ano_carrera" class="search-select">
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

    <div id="results"></div>

    <script src="scripts/search.js"></script>
</body>

</html>