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
  <link rel="stylesheet" href="estilos/editar_proyecto.css">
  <link rel="stylesheet" href="estilos/unificado.css">
  <link rel="stylesheet" href="estilos/styleheader.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <script src="scripts/editar_trabajo.js"></script>

</head>

<body>

  <?php
  include 'Imports/header.php';
  ?>

  <div class="header-image-index"></div>

  <?php
  include 'Imports/barranav.php';
  ?>
  <h1 id="titulo">Edita tu trabajo </h1>
  <div class="project-container">

    <div class="left-column">
      <h2 id="titulo-img">Imagen del trabajo</h2>
      <div class="project-image">
        <img src="<?php echo htmlspecialchars($trabajo['portada']); ?>" alt="Imagen del trabajo">
        <!-- Botón para cambiar la imagen -->
        <button class="change-image-btn">Cambiar Imagen</button>
      </div>

      <div class="project-info">
        <div class="input-group">
          <h2>Título del trabajo</h2>
          <input id="input_titulo" type="text" value="<?php echo htmlspecialchars($trabajo['titulo']); ?>">
        </div>

        <div class="input-group">
          <h2>Descripción del trabajo</h2>
          <textarea name="descripcion" id="descripcion" cols="30"
            rows="10"><?php echo htmlspecialchars($trabajo['descripcion']); ?></textarea>
        </div>

        <div class="input-group">
          <h2>Horas de desarrollo</h2>
          <input id="input_horas" type="number" value="<?php echo $trabajo['horas']; ?>" min="1" step="1"> horas
        </div>

        <div class="input-group">
          <h2>Tipo de trabajo</h2>
          <select name="tipo_proyecto" id="tipo_proyecto">
            <option value="TFG" <?php echo $trabajo['tipo'] == 'TFG' ? 'selected' : ''; ?>>TFG</option>
            <option value="TFM" <?php echo $trabajo['tipo'] == 'TFM' ? 'selected' : ''; ?>>TFM</option>
            <option value="Práctica" <?php echo $trabajo['tipo'] == 'Práctica' ? 'selected' : ''; ?>>Práctica</option>
            <option value="Proyecto" <?php echo $trabajo['tipo'] == 'Proyecto' ? 'selected' : ''; ?>>Proyecto</option>
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
          <div id="documentList"> <!-- Contenedor para los documentos añadidos -->
            <!-- Aquí se añadirán los documentos dinámicamente -->
          </div>
          <a href="#" class="view-all">Ver todos</a>
        </section>

      </article>
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
</body>

</html>