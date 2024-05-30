<?php
include 'scripts/conexion.php';
include 'scripts/controlSesion.php';

// Supongamos que recuperamos el ID del trabajo desde la URL
$id_trabajo = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id_trabajo == 0) {
  die("ID de trabajo no especificado o inválido.");
}

// Preparamos y ejecutamos la consulta
$stmt = $conn->prepare("SELECT titulo, descripcion, portada, horas, tipo FROM trabajos WHERE id_trabajo = ?");
$stmt->bind_param("i", $id_trabajo);
$stmt->execute();
$result = $stmt->get_result();

if ($trabajo = $result->fetch_assoc()) {
  // Ahora tienes los datos del trabajo en la variable $trabajo
} else {
  die("Trabajo no encontrado.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Proyecto</title>
  <link rel="stylesheet" href="estilos/unificado.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="imports/fontello/css/fontello.css">
  <?php include 'scripts/controlEstilo.php'; ?>
  <?php include 'scripts/controlTamano.php'; ?>
  <script src="scripts/editar_trabajo.js"></script>

</head>

<body>

  <?php
  include 'Imports/header.php';
  ?>

  <h1 id="titulo" class="titulo-edit"><?php echo $palabras['editPory'] ?> </h1>
  <div class="project-container-edit">

    <div class="left-column-edit">
      <h2 id="titulo-img"><?php echo $palabras['Imgdelproy'] ?></h2>
      <div class="project-image-edit">
        <img id="currentProjectImage" src="<?php echo htmlspecialchars($trabajo['portada']); ?>"
          alt="Imagen del trabajo">
        <input type="file" id="file-upload" class="file-upload-edit" style="display: none;" onchange="handleNewImageSelection();" />
        <button class="change-image-btn-edit" onclick="document.getElementById('file-upload').click();"><?php echo $palabras['cambimg'] ?></button>
      </div>

      <div class="project-info-edit">
        <div class="input-group-edit">
          <h2><?php echo $palabras['titleproy'] ?></h2>
          <input id="input_titulo" class="input_titulo-edit" type="text" value="<?php echo htmlspecialchars($trabajo['titulo']); ?>">
        </div>

        <div class="input-group-edit">
          <h2><?php echo $palabras['descproy'] ?></h2>
          <textarea name="descripcion" id="descripcion" class="descripcion-edit" cols="30"
            rows="10"><?php echo htmlspecialchars($trabajo['descripcion']); ?></textarea>
        </div>

        <div class="input-group-edit">
          <h2><?php echo $palabras['horas'] ?></h2>
          <input id="input_horas" class="input_horas-edit" type="number" value="<?php echo $trabajo['horas']; ?>" min="1" step="1"> <?php echo $palabras['horas'] ?>
        </div>

        <div class="input-group-edit">
          <h2><?php echo $palabras['tipo'] ?></h2>
          <select name="tipo_proyecto" id="tipo_proyecto" class="select-config">
            <option value="TFG" <?php echo $trabajo['tipo'] == 'TFG' ? 'selected' : ''; ?>><?php echo $palabras['tfg'] ?></option>
            <option value="TFM" <?php echo $trabajo['tipo'] == 'TFM' ? 'selected' : ''; ?>><?php echo $palabras['tfm'] ?></option>
            <option value="Práctica" <?php echo $trabajo['tipo'] == 'Práctica' ? 'selected' : ''; ?>><?php echo $palabras['practic'] ?></option>
            <option value="Proyecto" <?php echo $trabajo['tipo'] == 'Proyecto' ? 'selected' : ''; ?>><?php echo $palabras['project'] ?></option>
          </select>
        </div>
      </div>
    </div>

    <div class="right-column-edit">
      <article class="resources-section-edit">
        <h2><?php echo $palabras['Recmulti'] ?> <button class="upload-button-edit" onclick="openUploadFileModal()"><?php echo $palabras['subirarch'] ?></button></h2>
        <hr>
        <section class="documents-edit">
          <div id="documentList"> <!-- Contenedor para los documentos añadidos -->
            <!-- Aquí se añadirán los documentos dinámicamente -->
          </div>
        </section>

      </article>
    </div>
  </div>

  <div id="subir_proyecto" class="subir_proyecto-edit">
    <button class="upload-button-edit" onclick="validateAndUploadProject()"><?php echo $palabras['guardar'] ?></button>

  </div>


  <script src="script.js"></script>

  <!-- Modal para subir archivos con nuevos ID y clases -->
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
          <div id="fileNameDisplay" class="fileNameDisplay"></div>
        </label>
        <br>
        <img id="uploadImagePreview" class="uploadImagePreview">
        <button onclick="addUploadFileToList()">Añadir</button>
      </div>
    </div>
</body>

<!-- Modal para documentos -->
<div id="documentModal" class="modal">
  <div class="modal-content">
    <span class="close" data-modal-id="documentModal">&times;</span>
    <h2>Documentos Asociados</h2>
    <hr>
    <div id="document-list">
      <!-- Aquí se cargarán los documentos con AJAX -->
    </div>
  </div>
</div>

<!-- Modal para imágenes -->
<div id="documentModalImage" class="modal">
  <div class="modal-content">
    <span class="close" data-modal-id="documentModalImage">&times;</span>
    <h2>Imágenes Asociadas</h2>
    <hr>
    <div id="photos-list">
      <!-- Aquí se cargarán las imágenes con AJAX -->
    </div>
  </div>
</div>

<div id="imageModal" class="modal">
  <div class="modal-image modal-image-content">
    <span class="close" data-modal-id="imageModal">&times;</span>
    <img id="modal-image" src="" alt="Imagen en grande">
  </div>
</div>

</html>