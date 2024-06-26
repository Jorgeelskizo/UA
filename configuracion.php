<?php
include 'scripts/conexion.php';
include 'scripts/controlSesion.php';

include 'scripts/seleccionarIdioma.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidad de Alicante - Proyecto Fin de Grado Ingenieria Multimedia</title>
    <link rel="stylesheet" href="estilos/unificado.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="imports/fontello/css/fontello.css">
    <?php include 'scripts/controlEstilo.php'; ?>
    <?php include 'scripts/controlTamano.php'; ?>

</head>

<body>

    <?php include "imports/header.php" ?>
    <h1 id="titulo-config"><?php echo  $palabras['configtit'] ?></h1>
    <div class="project-container-config">

        <div class="left-column-config">
            <div class="setting-config">
                <div class="setting-description-config">
                    <div class="title-config"><?php echo  $palabras['modoDalt'] ?></div>
                    <p><?php echo  $palabras['descdalt'] ?></p>
                </div>
                <div class="setting-control-config">
                    <select class="select-config" id="daltonico-select">
                        <option value="r" <?php echo (isset($_SESSION['modo']) && $_SESSION['modo'] == 'Delta') ? 'selected' : ''; ?>>Deuteranomalia</option>
                        <option value="p" <?php echo (isset($_SESSION['modo']) && $_SESSION['modo'] == 'Pro') ? 'selected' : ''; ?>>Protanopia</option>
                        <option value="t" <?php echo (isset($_SESSION['modo']) && $_SESSION['modo'] == 'Triple') ? 'selected' : ''; ?>>Tritanopia</option>
                    </select>
                </div>
            </div>

            <div class="setting-config">
                <div class="setting-description-config">
                    <div class="title-config"><?php echo  $palabras['modoosc'] ?></div>
                    <p><?php echo  $palabras['descosc'] ?></p>
                </div>
                <div class="setting-control-config">
                    <select class="select-config" id="oscuro-select">
                        <option value="a" <?php echo (isset($_SESSION['modo']) && $_SESSION['modo'] == 'Oscuro') ? 'selected' : ''; ?>>Activado</option>
                        <option value="d" <?php echo (isset($_SESSION['modo']) && $_SESSION['modo'] == '') ? 'selected' : ''; ?>>Desactivado</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="right-column-config">
            <div class="setting-config">
                <div class="setting-description-config">
                    <div class="title-config"><?php echo  $palabras['modobajavis'] ?></div>
                    <p><?php echo  $palabras['descvis'] ?></p>
                </div>
                <div class="setting-control-config">
                    <select class="select-config" id="tam-select">
                        <option value="1" <?php echo (isset($_SESSION['tam']) && $_SESSION['tam'] == '1') ? 'selected' : ''; ?>>1</option>
                        <option value="2" <?php echo (isset($_SESSION['tam']) && $_SESSION['tam'] == '2') ? 'selected' : ''; ?>>2</option>
                        <option value="3" <?php echo (isset($_SESSION['tam']) && $_SESSION['tam'] == '3') ? 'selected' : ''; ?>>3</option>
                    </select>
                </div>
            </div>

            <div class="setting-config">
                <div class="setting-description-config">
                    <div class="title-config"><?php echo  $palabras['cambIdi'] ?></div>
                    <p><?php echo  $palabras['desidi'] ?></p>
                </div>
                <div class="setting-control-config">
                    <select class="select-config" id="language-select">
                        <option value="es" <?php echo (isset($_SESSION['lang']) && $_SESSION['lang'] == 'es') ? 'selected' : ''; ?>>Español</option>
                        <option value="in" <?php echo (isset($_SESSION['lang']) && $_SESSION['lang'] == 'in') ? 'selected' : ''; ?>>Inglés</option>
                        <option value="ch" <?php echo (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ch') ? 'selected' : ''; ?>>Chino</option>
                    </select>
                </div>
            </div>
        </div>
    </div>


    <script src="scripts/seleccionar.js"></script>


</body>

</html>