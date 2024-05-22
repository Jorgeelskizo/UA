<?php 
include 'scripts/conexion.php';
include 'scripts/controlSesion.php';

// Recoger el ID del proyecto de la URL
$id_proyecto = isset($_GET['id']) ? intval($_GET['id']) : 0;
echo $id_proyecto;

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Universidad de Alicante - Proyecto Fin de Grado Ingenieria Multimedia</title>
<link rel="stylesheet" href="estilos/unificado.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
  <?php echo $_SESSION["id"]; ?>
  <?php echo $row["id_usu"]; ?>

  <?php if ($_SESSION["id"] == $row["id_usu"]): ?>
        <button class="form-button" onclick="location.href='editar_trabajo.php?id=<?php echo $id_trabajo; ?>'">Editar Documento</button>
    <?php endif; ?>
    <div class="project-image">
        <img src="<?php echo $portada; ?>" alt="Project Thumbnail" class="fixed-size">
    </div>
    <div class="project-info">
        <?php echo "<h2>" . $titulo. "</h2>"; ?>

        <div class="project-meta">
            <p class="author">Hecho por <span class="author-name"><a href="perfilajeno.php?id=<?php echo $row['id_usu']; ?>"><?php echo $row["nombre_completo"]; ?></a></span></p>
            <p class="time-ago"><?php echo $horas ." horas"; ?></p>
            <p class="rating">Valoración <?php echo $valoracion; ?> /5.0</p>
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
            <form action="scripts/submit-comment.php" method="POST">
                <label for="comment-input" class="visually-hidden">Añade un comentario</label>
                <input type="text" id="comment-input" name="titulo" placeholder="Titulo">
                <input type="text" id="comment-input" name="comentario" placeholder="Escribe un comentario">
                <input type="hidden" name="id_trabajo" value="<?php echo $id_proyecto; ?>">
                <input type="submit" value="Enviar">
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
          $pdf_sql = "SELECT nombre, titulo, descripcion 
                      FROM pdf 
                      WHERE nombre LIKE '%.pdf' 
                      AND id_proyecto = $id_proyecto
                      ORDER BY id_pdf ASC 
                      LIMIT 2";
          $pdf_result = $conn->query($pdf_sql);
          if ($pdf_result->num_rows > 0) {
              while ($pdf_row = $pdf_result->fetch_assoc()) {
          ?>
          <div class="document-item">
            <span class="document-icon"><img src="img/pdf.png"></span> 
            <div class="document-info">
              <p class="document-title"><?php echo $pdf_row['descripcion']; ?></p>
              <p class="document-description">Archivo pdf con el proyecto completo.</p>
            </div>
            <a href="#" class="download-button" download>Descargar</a>
          </div>
          <hr>
          <?php 
              }
          } else {
              echo "<p>No hay documentos disponibles.</p>";
          }
          ?>
          <a href="#" class="view-all">Ver todos</a>
        </section>
          
          <section class="other">
            <h3>Otros</h3>
            <div class="carousel-container">
              <div class="carousel-slide">
                <img src="img/pasoPeatones.jpg" alt="Imagen 1" class="carousel-image">
                <img src="img/logoUA.png" alt="Imagen 2" class="carousel-image">
                <img src="img/pdf.png" alt="Imagen 3" class="carousel-image">
                <!-- Agrega tantas imágenes como desees en el carrusel aquí -->
              </div>
              <button id="prevBtn" class="carousel-btn prev">❮</button>
              <button id="nextBtn" class="carousel-btn next">❯</button>
            </div>  
               
          </section>
      </article>

      <div class="project-actions">
        <div class="rate-project">
          <span class="rate-title">Valorar proyecto</span>
          <div class="valorar">
            <button class="rate-button">★</button>
            <form action="">
              <select name="" id="estrellas">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </form>
          </div>
        </div>
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


<?php include 'imports/footer.php'; ?>


<script src="script.js"></script>





<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Documentos Disponibles</h2>
    <hr>
    <section class="documents" id="all-documents">
      <!-- Los documentos se cargarán aquí dinámicamente -->
    </section>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("modal");
    var closeModal = document.getElementsByClassName("close")[0];
    var viewAllLink = document.querySelector('.view-all');

    viewAllLink.addEventListener('click', function(event) {
        event.preventDefault();
        fetch('get_all_documents.php')
            .then(response => response.json())
            .then(data => {
                var allDocumentsContainer = document.getElementById('all-documents');
                allDocumentsContainer.innerHTML = ''; // Clear previous content
                data.forEach(doc => {
                    var documentItem = document.createElement('div');
                    documentItem.classList.add('document-item');
                    documentItem.innerHTML = `
                        <span class="document-icon"><img src="img/pdf.png"></span> 
                        <div class="document-info">
                            <p class="document-title">${doc.texto_alternativo}</p>
                            <p class="document-description">Archivo pdf con el proyecto completo.</p>
                        </div>
                        <a href="${doc.nombre_archivo}" class="download-button" download>Descargar</a>
                        <hr>
                    `;
                    allDocumentsContainer.appendChild(documentItem);
                });
                modal.style.display = "block";
            });
    });

    closeModal.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});
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