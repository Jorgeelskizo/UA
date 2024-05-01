<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidad de Alicante - Proyecto Fin de Grado Ingenieria Multimedia</title>
    <link rel="stylesheet" href="estilos/publicar_proyecto.css">
    <link rel="stylesheet" href="estilos/styleheader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

    <?php include "imports/header.php" ?>
    <h1 id="titulo">Publica tu proyecto</h1>
    <div class="project-container">

        <div class="left-column">
            <h2 id="titulo">Imagen del proyecto</h2>
            <div class="project-image">
                <label for="file-upload" class="custom-file-upload">
                    <i class="fa fa-cloud-upload-alt"></i> Subir imagen
                </label>
                <input id="file-upload" type="file" style="display:none;" />
            </div>

            <div class="project-info">
                <h2 id="titulo">Titulo del proyecto</h2>
                <input id="input_titulo" type="text">

                <h2 id="titulo">Descripción del proyecto</h2>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>

            </div>
        </div>

        <div class="right-column">
            <article class="resources-section">
                <h2>Recursos Multimedia Asociados <button class="upload-button">Subir Archivo</button></h2>
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
                    <!-- Add more documents here if needed -->
                    <a href="#" class="view-all">Ver todos</a>
                </section>

            </article>

            <div class="project-actions">
                <div class="share-project">
                    <span class="share-title">Compartir Proyecto</span>
                    <div class="social-icons">
                        <!-- Los íconos pueden ser de FontAwesome o imágenes -->
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="subir_proyecto">
        <button class="upload-button">Subir Proyecto</button>
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