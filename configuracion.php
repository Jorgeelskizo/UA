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
    <link rel="stylesheet" href="estilos/configuracion.css">
    <link rel="stylesheet" href="estilos/unificado.css">
    <link rel="stylesheet" href="estilos/styleheader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<?php echo $idioma?>

<body>

    <?php include "imports/header.php" ?>
    <h1 id="titulo-config">Configuración de accesibilidad</h1>
    <div class="project-container-config">

        <div class="left-column-config">
            <div class="setting-config">
                <div class="setting-description-config">
                    <div class="title-config">Modo daltónico</div>
                    <p>Configura un modo daltónico en caso de padecer daltonismo.</p>
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
                    <div class="title-config">Modo Oscuro</div>
                    <p>Establece un modo oscuro para situaciones de luz bajas.</p>
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
                    <div class="title-config">Modo baja visibilidad</div>
                    <p>Configura el tamaño de las letras en caso de tener problemas de visión</p>
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
                    <div class="title-config">Cambiar idioma</div>
                    <p>Configura el idioma que prefieras y que esté disponible en nuestra base de datos</p>
                </div>
                <div class="setting-control-config">
                    <select class="select-config" id="language-select">
                        <option value="es">Español</option>
                        <option value="in">Inglés</option>
                        <option value="ch">Chino</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div id="subir_proyecto-config">
        <button class="upload-button-config">Guardar Cambios</button>
    </div>


    <?php include 'imports/footer.php'; ?>


    


    <!-- Ventana emergente para "Ver todos" -->
    <div id="modal-config" class="modal-config">
        <div class="modal-content-config">
            <span class="close-config">&times;</span>
            <h2>Documentos Disponibles</h2>
            <hr>
            <section class="documents-config">
                <h3>Documentos</h3>
                <div class="document-item-config">
                    <span class="document-icon-config"><img src="img/pdf.png"></span>
                    <div class="document-info-config">
                        <p class="document-title-config">Proyecto completo</p>
                        <p class="document-description-config">Archivo pdf con el proyecto completo.</p>
                    </div>
                    <button class="download-button-config">Descargar</button>
                    <button class="delete-button-config">Eliminar</button>
                </div>
                <hr>
                <div class="document-item-config">
                    <span class="document-icon-config"><img src="img/pdf.png"></span>
                    <div class="document-info-config">
                        <p class="document-title-config">Proyecto completo</p>
                        <p class="document-description-config">Archivo pdf con el proyecto completo.</p>
                    </div>
                    <button class="download-button-config">Descargar</button>
                    <button class="delete-button-config">Eliminar</button>
                </div>
                <hr>
                <div class="document-item-config">
                    <span class="document-icon-config"><img src="img/pdf.png"></span>
                    <div class="document-info-config">
                        <p class="document-title-config">Proyecto completo</p>
                        <p class="document-description-config">Archivo pdf con el proyecto completo.</p>
                    </div>
                    <button class="download-button-config">Descargar</button>
                    <button class="delete-button-config">Eliminar</button>
                </div>
                <hr>
                <div class="document-item-config">
                    <span class="document-icon-config"><img src="img/pdf.png"></span>
                    <div class="document-info-config">
                        <p class="document-title-config">Proyecto completo</p>
                        <p class="document-description-config">Archivo pdf con el proyecto completo.</p>
                    </div>
                    <button class="download-button-config">Descargar</button>
                    <button class="delete-button-config">Eliminar</button>
                </div>
                <hr>
                <div class="document-item-config">
                    <span class="document-icon-config"><img src="img/pdf.png"></span>
                    <div class="document-info-config">
                        <p class="document-title-config">Proyecto completo</p>
                        <p class="document-description-config">Archivo pdf con el proyecto completo.</p>
                    </div>
                    <button class="download-button-config">Descargar</button>
                    <button class="delete-button-config">Eliminar</button>
                </div>

            </section>
        </div>
    </div>

    <script src="scripts/modal.js"></script>
    <script src="scripts/carrusel.js"></script>
    <script src="scripts/seleccionar.js"></script>


</body>

</html>