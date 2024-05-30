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
  <title>Universidad de Alicante - Proyecto Fin de Grado Ingenieria Multimedia</title>
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

  <h1 id="titulo" class="titulo-edit">Edita tu trabajo </h1>
  <div class="project-container-edit">

    <div class="left-column-edit">
      <h2 id="titulo-img">Imagen del trabajo</h2>
      <div class="project-image-edit">
        <img id="currentProjectImage" src="<?php echo htmlspecialchars($trabajo['portada']); ?>"
          alt="Imagen del trabajo">
        <input type="file" id="file-upload" class="file-upload-edit" style="display: none;" onchange="handleNewImageSelection();" />
        <button class="change-image-btn-edit" onclick="document.getElementById('file-upload').click();">Cambiar
          Imagen</button>
      </div>

      <div class="project-info-edit">
        <div class="input-group-edit">
          <h2>Título del trabajo</h2>
          <input id="input_titulo" class="input_titulo-edit" type="text" value="<?php echo htmlspecialchars($trabajo['titulo']); ?>">
        </div>

        <div class="input-group-edit">
          <h2>Descripción del trabajo</h2>
          <textarea name="descripcion" id="descripcion" class="descripcion-edit" cols="30"
            rows="10"><?php echo htmlspecialchars($trabajo['descripcion']); ?></textarea>
        </div>

        <div class="input-group-edit">
          <h2>Horas de desarrollo</h2>
          <input id="input_horas" class="input_horas-edit" type="number" value="<?php echo $trabajo['horas']; ?>" min="1" step="1"> horas
        </div>

        <div class="input-group-edit">
          <h2>Tipo de trabajo</h2>
          <select name="tipo_proyecto" id="tipo_proyecto" class="select-config">
            <option value="TFG" <?php echo $trabajo['tipo'] == 'TFG' ? 'selected' : ''; ?>>TFG</option>
            <option value="TFM" <?php echo $trabajo['tipo'] == 'TFM' ? 'selected' : ''; ?>>TFM</option>
            <option value="Práctica" <?php echo $trabajo['tipo'] == 'Práctica' ? 'selected' : ''; ?>>Práctica</option>
            <option value="Proyecto" <?php echo $trabajo['tipo'] == 'Proyecto' ? 'selected' : ''; ?>>Proyecto</option>
          </select>
        </div>
      </div>
    </div>

    <div class="right-column-edit">
      <article class="resources-section-edit">
        <h2>Recursos Multimedia Asociados <button class="upload-button-edit" onclick="openUploadFileModal()">Subir
            Archivo</button></h2>
        <hr>
        <section class="documents-edit">
          <h3>Documentos</h3>
          <div id="documentList"> <!-- Contenedor para los documentos añadidos -->
            <!-- Aquí se añadirán los documentos dinámicamente -->
          </div>
          <a href="#" class="view-all-edit">Ver todos</a>
        </section>

      </article>
    </div>
  </div>

  <div id="subir_proyecto" class="subir_proyecto-edit">
    <button class="upload-button-edit" onclick="validateAndUploadProject()">Guardar Cambios</button>

  </div>


  <script src="script.js"></script>





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
          <div id="fileNameDisplay" class="fileNameDisplay"></div>
        </label>
        <br>
        <img id="uploadImagePreview" class="uploadImagePreview">
        <button onclick="addUploadFileToList()">Añadir</button>
      </div>
    </div>
</body>

</html>