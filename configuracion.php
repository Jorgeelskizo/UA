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
    <?php include 'scripts/controlEstilo.php'; ?>

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
                    <select>
                        <option>Deuteranomalia</option>
                        <option>Protanopia</option>
                        <option>Tritanopia</option>
                    </select>
                </div>
            </div>

            <div class="setting-config">
                <div class="setting-description-config">
                    <div class="title-config"><?php echo  $palabras['modoosc'] ?></div>
                    <p><?php echo  $palabras['descosc'] ?></p>
                </div>
                <div class="setting-control-config">
                    <label class="switch-config">
                        <input class="input-config" type="checkbox-config">
                        <span class="slider round-config"></span>
                    </label>
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
                    <select class="select-config">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
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

    <div id="subir_proyecto-config">
        <button class="upload-button-config">Guardar Cambios</button>
    </div>


    <?php include 'imports/footer.php'; ?>

    <script src="scripts/seleccionar.js"></script>


</body>

</html>