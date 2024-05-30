<?php 
include 'scripts/conexion.php';
include 'scripts/controlSesion.php';
include 'scripts/seleccionarIdioma.php';

// Recoger el ID del proyecto de la URL
$id_proyecto = isset($_GET['id']) ? intval($_GET['id']) : 0;

$rating_sql = "SELECT AVG(valoracion) as media_valoracion FROM valoraciones WHERE id_trabajo = ?";
$stmt = $conn->prepare($rating_sql);
$stmt->bind_param('i', $id_proyecto);
$stmt->execute();
$result = $stmt->get_result();

$media_valoracion = 0;
if ($rating_row = $result->fetch_assoc()) {
    $media_valoracion = $rating_row['media_valoracion'];
}
$stmt->close();



?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detalles de proyecto</title>
<link rel="stylesheet" href="estilos/unificado.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<?php include 'scripts/controlEstilo.php'; ?>
<?php include 'scripts/controlTamano.php'; ?>

</head>

<body>

  <?php include "imports/header.php"?>

<div class="project-container">

  <?php 
  $sql = "SELECT  id_trabajo, titulo, descripcion, horas, valoracion, fecha_publicacion, nombre_completo, 
                  t.id_usuario as id_usu, portada
          FROM trabajos t
          JOIN usuarios u ON t.id_usuario = u.id_usuario
          WHERE t.id_trabajo = $id_proyecto  ";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $portada = $row["portada"];
    $titulo = $row["titulo"];
    $horas = $row["horas"];
    $valoracion = $row["valoracion"];
    $descripcion = $row["descripcion"];
    $id_trabajo = $row["id_trabajo"];
  ?>

<div class="left-column">
    <div class="project-image">
        <img src="<?php echo $portada; ?>" alt="Imagen destacada del proyecto" class="fixed-size">
    </div>
    <div class="project-info">
      <div class="titulo-y-editar">    
        <?php echo "<h2>" . $titulo. "</h2>"; ?>
        <div class="interior">
        <?php if (isset($_SESSION["id"]) && $_SESSION["id"] == $row["id_usu"]): ?>
          <button type="submit" class="editar-proyecto" onclick="location.href='editar_trabajo.php?id=<?php echo $id_trabajo; ?>'">Editar Documento</button>
        <?php endif; ?>
        <?php if (isset($_SESSION["id"]) && $_SESSION["id"] == $row["id_usu"]): ?>
          <form id="delete-project-form" action="scripts/delete-project.php" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este proyecto?');">
            <input type="hidden" name="id_trabajo" value="<?php echo $id_trabajo; ?>">
            <button type="submit" class="eliminar-proyecto">Eliminar Proyecto</button>
          </form>
        <?php endif; ?>
        </div>
      </div>

        <div class="project-meta">
            <p class="author">Hecho por <span class="author-name"><a href="perfilajeno.php?id=<?php echo $row['id_usu']; ?>"><?php echo $row["nombre_completo"]; ?></a></span></p>
            <p class="time-ago"><?php echo $horas ." horas"; ?></p>
            <p class="rating">Valoración <?php echo number_format($media_valoracion, 1); ?> /5.0</p>
        </div>

        <h3>Descripción del proyecto</h3>
        <?php echo "<p>" . $descripcion. "</p>"; ?>
        
        <h3>Últimos comentarios</h3>
        <hr>
        <div class="comment-section">
        <?php 
              $comment_sql = "SELECT c.titulo, c.descripcion, c.fecha_publicacion, u.nombre_completo, u.foto 
                              FROM comentarios c
                              JOIN usuarios u ON c.id_usuario = u.id_usuario
                              WHERE c.id_trabajo = $id_proyecto
                              ORDER BY c.fecha_publicacion DESC";
              $comment_result = $conn->query($comment_sql);
              if ($comment_result->num_rows > 0) {
                  while ($comment_row = $comment_result->fetch_assoc()) {
              ?>
              
              <div class="comment">
                <div class="imagen-comentario-contenedor">
                  <img src="<?php echo $comment_row['foto']; ?>" alt="<?php echo $comment_row['nombre_completo']; ?>" class="comment-avatar">
                </div>
                  <div class="comment-title"><?php echo $comment_row['titulo']; ?></div>
                  <div class="comment-caption"><?php echo $comment_row['descripcion']; ?><br><?php echo $comment_row['fecha_publicacion']; ?></div>
              </div>
              <hr>

              <?php 
                  }
                } else {
                    echo "<p>No hay comentarios todavía.</p>";
                }
              ?>
            <form action="scripts/submit-comment.php" method="POST" class="comentarios-formulario">
              <p>Deja un comentario</p>
              <!-- <label for="comment-title" class="visually-hidden">Título del comentario</label> -->
              <input type="text" id="comment-inout" name="titulo" placeholder="Título del comentario" class="input-comment">
              <!-- <label for="comment-input" class="visually-hidden">Escribe un comentario</label> -->
              <input type="text" id="comment-input" name="comentario" placeholder="Escribe un comentario" class="input-comment">
              <input type="hidden" name="id_trabajo" value="<?php echo $id_proyecto; ?>">
              <input type="submit" value="Enviar" class="download-button">
          </form>
        </div>
      </div>
    </div>

    <div class="right-column">
        <article class="resources-section">
          <h2>Recursos Multimedia Asociados</h2>
          <hr>
          <section class="documents">
          <h3>Documentos</h3>
          <?php
          $pdf_sql = "SELECT nombre, titulo, descripcion, ruta 
                      FROM pdf 
                      WHERE id_proyecto = $id_proyecto
                      ORDER BY id_pdf ASC 
                      LIMIT 3";
          $pdf_result = $conn->query($pdf_sql);
          if ($pdf_result->num_rows > 0) {
              while ($pdf_row = $pdf_result->fetch_assoc()) {
          ?>
          <div class="document-item">
            <span class="document-icon"><img src="img/pdf.png" alt="Icono de pdf"></span> 
            <div class="document-info">
              <p class="document-title"><?php echo $pdf_row['titulo']; ?></p>
              <p class="document-description"><?php echo $pdf_row['descripcion']; ?></p>
            </div>
            <a href="<?php echo $pdf_row['ruta']; ?>" class="download-button" download>Descargar</a>
          </div>
          <hr>
          <?php 
              }
          ?>
          
          <?php
          } else {
              echo "<p>No hay documentos disponibles.</p>";
          }
          ?>
          <a href="#" class="view-all">Ver todos los documentos</a>
          
          <h3 id="h3-imagenes">Imágenes</h3>

          <?php
          $img_sql = "SELECT nombre, texto_alternativo, nombre_archivo 
                      FROM archivos 
                      WHERE id_trabajo = $id_proyecto
                      ORDER BY id_archivo ASC 
                      LIMIT 3";
          $img_result = $conn->query($img_sql);
          if ($img_result->num_rows > 0) {
              while ($img_row = $img_result->fetch_assoc()) {
          ?>
          <div class="document-item">
            <span class="document-icon"><img src="img/image.png" alt="Icono de img"></span> 
            <div class="document-info">
                <p class="document-title"><?php echo htmlspecialchars($img_row['nombre']); ?></p>
                <p class="document-description"><?php echo htmlspecialchars($img_row['texto_alternativo']); ?></p>
            </div>
            
            <a href="#" class="view-button download-button" data-image-url="<?php echo htmlspecialchars($img_row['nombre_archivo']); ?>">Ver</a>
            <a href="<?php echo htmlspecialchars($img_row['nombre_archivo']); ?>" class="download-button" download>Descargar</a>
          </div>
          <hr>
          <?php 
              }
              ?>
          
          <?php
          } else {
              echo "<p>No hay imágenes disponibles.</p>";
          }
          ?>
          <a href="#" class="view-all-photos">Ver todas las imágenes</a>
        </section>
          
          <!-- <section class="other">
            <h3>Otros</h3>
            <div class="carousel-container">
              <div class="carousel-slide">
                <img src="img/pasoPeatones.jpg" alt="Imagen 1" class="carousel-image">
                <img src="img/logoUA.png" alt="Imagen 2" class="carousel-image">
                <img src="img/pdf.png" alt="Imagen 3" class="carousel-image">
              </div>
              <button id="prevBtn" class="carousel-btn prev">❮</button>
              <button id="nextBtn" class="carousel-btn next">❯</button>
            </div>  
          </section> -->
      </article>

      <div class="project-actions">
      <div class="rate-project">
        <span class="rate-title">Valorar proyecto</span>
        <div class="valorar">
            <form id="rate-form" action="scripts/submit-rating.php" method="POST">
                <div class="star-rating">
                    <input type="radio" id="star5" name="estrellas" value="5" /><label for="star5" title="5 stars">★</label>
                    <input type="radio" id="star4" name="estrellas" value="4" /><label for="star4" title="4 stars">★</label>
                    <input type="radio" id="star3" name="estrellas" value="3" /><label for="star3" title="3 stars">★</label>
                    <input type="radio" id="star2" name="estrellas" value="2" /><label for="star2" title="2 stars">★</label>
                    <input type="radio" id="star1" name="estrellas" value="1" /><label for="star1" title="1 star">★</label>
                </div>
                <input type="hidden" name="id_trabajo" value="<?php echo $id_trabajo; ?>">
                <input type="submit" name="enviar" id="sb" value="Enviar">
            </form>
        </div>
    </div>
        <div class="share-project">
          <span class="share-title">Compartir Proyecto</span>
          <div class="social-icons">
            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
    </div>
</div>

<script src="script.js"></script>

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

<!-- Modal para ver una imagen en grande -->
<div id="imageModal" class="modal">
  <div class="modal-image modal-image-content">
    <span class="close" data-modal-id="imageModal">&times;</span>
    <img id="modal-image" src="" alt="Imagen en grande">
  </div>
</div>

<script>
// Lógica para abrir y cerrar el modal
var modal = document.getElementById("documentModal");
var modal1 = document.getElementById("documentModalImage");
var imageModal = document.getElementById("imageModal");

var btn = document.querySelector(".view-all");
var btnImg = document.querySelector(".view-all-photos");

var closeBtns = document.getElementsByClassName("close");

for (var i = 0; i < closeBtns.length; i++) {
  closeBtns[i].onclick = function() {
    var modalId = this.getAttribute("data-modal-id");
    document.getElementById(modalId).style.display = "none";
  }
}

btn.onclick = function() {
  modal.style.display = "block";
  loadDocuments(); // Llamar a la función para cargar documentos
}

btnImg.onclick = function() {
  modal1.style.display = "block";
  loadImages(); // Llamar a la función para cargar imágenes
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
  if (event.target == imageModal) {
    imageModal.style.display = "none";
  }
}

function loadImages() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "scripts/get_fotos.php?id_trabajo=<?php echo $id_trabajo; ?>", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById("photos-list").innerHTML = xhr.responseText;
      attachViewButtons();
    }
  };
  xhr.send();
}

function loadDocuments() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "scripts/get_documents.php?id_trabajo=<?php echo $id_trabajo; ?>", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById("document-list").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}

function attachViewButtons() {
  var viewButtons = document.getElementsByClassName("view-button");
  for (var i = 0; i < viewButtons.length; i++) {
    viewButtons[i].onclick = function(event) {
      event.preventDefault();
      var imageUrl = this.getAttribute("data-image-url");
      document.getElementById("modal-image").src = imageUrl;
      imageModal.style.display = "block";
    }
  }
}

document.addEventListener('DOMContentLoaded', attachViewButtons);
</script>

<script src="scripts/modal.js"></script>
<script src="scripts/carrusel.js"></script>

</body>
</html>

<?php
} else {
    echo "0 results";
}
$conn->close();
?>
