<?php
include 'scripts/conexion.php';
include 'scripts/controlSesion.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidad de Alicante - Subir Trabajo</title>
    <link rel="stylesheet" href="estilos/styleheader.css">
    <link rel="stylesheet" href="estilos/unificado.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <?php include 'scripts/controlEstilo.php'; ?>
    <?php include 'scripts/controlTamano.php'; ?>


    <script src="scripts/publicarTrabajo.js"></script>

</head>

<body>

    <?php
    include 'Imports/header.php';
    ?>

    <div class="header-image-index"></div>

    <?php
    include 'Imports/barranav.php';
    ?>
    <h1 id="titulo">Publica tu trabajo</h1>
    <div class="project-container">

        <div class="left-column">
            <h2 id="titulo">Imagen de portada</h2>
            <div class="project-image">
                <label for="file-upload" class="custom-file-upload">
                    <p><i class="fa fa-cloud-upload-alt"></i>Subir Imagen </p>
                    <input id="file-upload" class="file-upload" type="file" accept=".jpg, .jpeg, .png" style="display:none;"
                        onchange="previewImage();" />
                    <div id="image-preview-container" class="image-preview-container"
                        style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                        <img id="preview-img" class="preview-img" src="" alt="Preview Image"
                            style="width: 100%; height: 100%; display: none; object-fit: cover;" />
                    </div>
                </label>
                <input id="file-upload" class="file-upload" type="file" style="display:none;" onchange="previewImage();" />
            </div>


            <div class="project-info">
                <div class="input-group">
                    <h2>Título del trabajo</h2>
                    <input id="input_titulo" class="input_titulo" type="text">
                </div>

                <div class="input-group">
                    <h2>Descripción del trabajo</h2>
                    <textarea name="descripcion" id="descripcion" class="descripcion" cols="30" rows="10"></textarea>
                </div>

                <div class="input-group">
                    <h2>Horas de desarrollo</h2>
                    <input id="input_horas" class="input_horas" type="number" placeholder="E.g., 120" min="1" step="1"> horas
                </div>

                <div class="input-group">
                    <h2>Tipo de trabajo</h2>
                    <select name="tipo_proyecto" id="tipo_proyecto" class="tipo_proyecto">
                        <option value="TFG">TFG</option>
                        <option value="TFM">TFM</option>
                        <option value="Práctica">Práctica</option>
                        <option value="Proyecto">Proyecto</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="right-column">
            <article class="resources-section">
                <h2>Recursos Multimedia Asociados <button class="upload-button" onclick="openUploadFileModal()">Subir
                        Archivo</button></h2>
                <hr>
                <section class="documents">
                    <h3>Documentos</h3>
                    <div id="documentList" class="documentList"> <!-- Contenedor para los documentos añadidos -->
                        <!-- Aquí se añadirán los documentos dinámicamente -->
                    </div>
                    <a href="#" class="view-all">Ver todos</a>
                </section>

            </article>

            <div class="project-actions">
                <div class="share-project">
                    <span class="share-title">Compartir trabajo</span>
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
        <button id="upload-project-button" class="upload-button" onclick="validateAndUploadProject()">Subir
            trabajo</button>
    </div>



    <?php include 'imports/footer.php'; ?>

    <script src="scripts/modal.js"></script>

    <!-- Modal para subir archivos -->
    <<!-- Modal para subir archivos con nuevos ID y clases -->
        <div id="uploadFileModal" class="upload-modal" style="display: none;">
            <div class="upload-modal-content">
                <span class="upload-close" onclick="closeUploadFileModal()">&times;</span>
                <h2>Subir nuevo archivo</h2>
                <label>
                    Tipo de archivo:
                    <select id="uploadFileType" class="uploadFileType" onchange="toggleUploadFields()">
                        <option value="pdf">PDF</option>
                        <option value="image">Imagen</option>
                    </select>
                </label>
                <br>
                <label id="uploadTitleField" class="uploadFileTypetxt" style="display: none;">
                    Título:
                    <input type="text" id="uploadFileTitle" class="uploadFileType">
                </label>
                <br>
                <label id="uploadDescField" class="uploadDescField" style="display: none;">
                    Descripción:
                    <textarea id="uploadFileDescription" class="uploadFileDescription"></textarea>
                </label>
                <br>
                <label id="altTextField" class="altTextFieldtxt" style="display: none;">
                    Texto Alternativo:
                    <input type="text" id="uploadAltText" class="altTextField">
                </label>

                <br>
                <label>
                    Archivo:
                    <label for="uploadFileInput" class="upload-file-label">Seleccionar archivo</label>
                    <input type="file" id="uploadFileInput" class="uploadFileInput" onchange="previewUploadFile()" hidden />
                    <div id="fileNameDisplay"  class="fileNameDisplay"></div>
                </label>
                <br>
                <img id="uploadImagePreview" class="uploadImagePreview">
                <button onclick="addUploadFileToList()">Añadir</button>
            </div>
        </div>



</body>

</html>