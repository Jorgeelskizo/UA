<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidad de Alicante - Proyecto Fin de Grado Ingenieria Multimedia</title>
    <link rel="stylesheet" href="estilos/configuracion.css">
    <link rel="stylesheet" href="estilos/styleheader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

    <?php include "imports/header.php" ?>
    <h1 id="titulo">Configuración de accesibilidad</h1>
    <div class="project-container">

        <div class="left-column">
        <div class="setting">
            <div class="setting-description">
                <div class="title">Modo daltónico</div>
                <p>Configura un modo daltónico en caso de padecer daltonismo.</p>
            </div>
            <div class="setting-control">
                <select>
                    <option>Deuteranomalia</option>
                    <option>Protanopia</option>
                    <option>Tritanopia</option>
                </select>
            </div>
        </div>

        <div class="setting">
            <div class="setting-description">
                <div class="title">Modo Oscuro</div>
                <p>Establece un modo oscuro para situaciones de luz bajas.</p>
            </div>
            <div class="setting-control">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
        </div>

        <div class="right-column">
        <div class="setting">
            <div class="setting-description">
                <div class="title">Modo baja visibilidad</div>
                <p>Configura el tamaño de las letras en caso de tener problemas de visión</p>
            </div>
            <div class="setting-control">
                <select>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
        </div>

        <div class="setting">
            <div class="setting-description">
                <div class="title">Cambiar idioma</div>
                <p>Configura el idioma que prefieras y que esté disponible en nuestra base de datos</p>
            </div>
            <div class="setting-control">
                <select>
                    <option>Español</option>
                    <option>Inglés</option>
                    <option>Francés</option>
                </select>
            </div>
        </div>
        </div>
    </div>

    <div id="subir_proyecto">
        <button class="upload-button">Guardar Cambios</button>
    </div>


    <?php include 'imports/footer.php'; ?>


    <script src="script.js"></script>





    <!-- Ventana emergente para "Ver todos" -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Documentos Disponibles</h2>
            <hr>
            <section class="documents">
                <h3>Documentos</h3>
                <div class="document-item">
                    <span class="document-icon"><img src="img/pdf.png"></span>
                    <div class="document-info">
                        <p class="document-title">Proyecto completo</p>
                        <p class="document-description">Archivo pdf con el proyecto completo.</p>
                    </div>
                    <button class="download-button">Descargar</button>
                    <button class="delete-button">Eliminar</button>
                </div>
                <hr>
                <div class="document-item">
                    <span class="document-icon"><img src="img/pdf.png"></span>
                    <div class="document-info">
                        <p class="document-title">Proyecto completo</p>
                        <p class="document-description">Archivo pdf con el proyecto completo.</p>
                    </div>
                    <button class="download-button">Descargar</button>
                    <button class="delete-button">Eliminar</button>
                </div>
                <hr>
                <div class="document-item">
                    <span class="document-icon"><img src="img/pdf.png"></span>
                    <div class="document-info">
                        <p class="document-title">Proyecto completo</p>
                        <p class="document-description">Archivo pdf con el proyecto completo.</p>
                    </div>
                    <button class="download-button">Descargar</button>
                    <button class="delete-button">Eliminar</button>
                </div>
                <hr>
                <div class="document-item">
                    <span class="document-icon"><img src="img/pdf.png"></span>
                    <div class="document-info">
                        <p class="document-title">Proyecto completo</p>
                        <p class="document-description">Archivo pdf con el proyecto completo.</p>
                    </div>
                    <button class="download-button">Descargar</button>
                    <button class="delete-button">Eliminar</button>
                </div>
                <hr>
                <div class="document-item">
                    <span class="document-icon"><img src="img/pdf.png"></span>
                    <div class="document-info">
                        <p class="document-title">Proyecto completo</p>
                        <p class="document-description">Archivo pdf con el proyecto completo.</p>
                    </div>
                    <button class="download-button">Descargar</button>
                    <button class="delete-button">Eliminar</button>
                </div>

            </section>
        </div>
    </div>

    <script src="scripts/modal.js"></script>
    <script src="scripts/carrusel.js"></script>


</body>

</html>