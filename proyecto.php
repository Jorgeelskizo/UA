<?php 
include 'scripts/conexion.php';
include 'scripts/controlSesion.php';
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
  $sql = "SELECT  titulo, descripcion, horas, valoracion, fecha_publicacion, nombre_completo, 
                  t.id_usuario as id_usu, a.nombre_archivo as ruta
          FROM trabajos t
          JOIN usuarios u ON t.id_usuario = u.id_usuario
          join archivos a ON t.id_trabajo = a.id_trabajo
          WHERE t.id_trabajo = 1  ";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
  ?>

  
  <div class="left-column">
    <div class="project-image">
        <img src="<?php echo $row["ruta"] ?>" alt="Project Thumbnail">
    </div>
    <div class="project-info">
        <!-- <h2>Proyecto Fin de Grado Ingeniera Multimedia</h2> -->
        <?php echo "<h2>" . $row["titulo"]. "</h2>"; ?>

        <div class="project-meta">
            <p class="author">Hecho por <span class="author-name"><a href="perfilajeno.php?id=<?php echo $row['id_usu']; ?>"><?php echo $row["nombre_completo"]; ?></a></span></p>
            <p class="time-ago"><?php echo $row["horas"] ." horas"?></p>
            <p class="rating">Valoración <?php echo $row["valoracion"] ?> /5.0</p>
        </div>

        <h3>Descripción del proyecto</h3>
        <?php echo "<p>" . $row["descripcion"]. "</p>"; ?>
        <!-- <p>Descripción del proyecto Descripción del proyecto Descripción del proyecto Descripción del proyecto Descripción del proyecto Descripción del proyecto Descripción del proyectoDescripción del proyecto</p> -->
        
        <h3>Últimos comentarios</h3>
        <hr>
        <div class="comment-section">
            <div class="comment">
                <img src="tiger.jpg" alt="Tiger">
                <div class="comment-title">Title goes here</div>
                <div class="comment-caption">Caption line 1 here<br>Caption line 2 here</div>
            </div>
            <hr>
            <div class="comment">
                <img src="ostrich.jpg" alt="Ostrich">
                <div class="comment-title">Title goes here</div>
                <div class="comment-caption">Caption line 1 here<br>Caption line 2 here</div>
            </div>
            
            <form class="comment-box">
                <label for="comment-input" class="visually-hidden">Añade un comentario</label>
                <input type="text" id="comment-input" placeholder="Escribe un comentario">
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
            <div class="document-item">
              <span class="document-icon"><img src="img/pdf.png"></span> 
              <div class="document-info">
                <p class="document-title">Proyecto completo</p>
                <p class="document-description">Archivo pdf con el proyecto completo.</p>
              </div>
              <button class="download-button">Descargar</button>
            </div>
            <hr>
            <div class="document-item">
              <span class="document-icon"><img src="img/pdf.png"></span> 
              <div class="document-info">
                <p class="document-title">Proyecto completo</p>
                <p class="document-description">Archivo pdf con el proyecto completo.</p>
              </div>
              <button class="download-button">Descargar</button>
            </div>
            <!-- Add more documents here if needed -->
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
      </div>
      <hr>
      <div class="document-item">
        <span class="document-icon"><img src="img/pdf.png"></span> 
        <div class="document-info">
          <p class="document-title">Proyecto completo</p>
          <p class="document-description">Archivo pdf con el proyecto completo.</p>
        </div>
        <button class="download-button">Descargar</button>
      </div>
      <hr>
      <div class="document-item">
        <span class="document-icon"><img src="img/pdf.png"></span> 
        <div class="document-info">
          <p class="document-title">Proyecto completo</p>
          <p class="document-description">Archivo pdf con el proyecto completo.</p>
        </div>
        <button class="download-button">Descargar</button>
      </div>
      <hr>
      <div class="document-item">
        <span class="document-icon"><img src="img/pdf.png"></span> 
        <div class="document-info">
          <p class="document-title">Proyecto completo</p>
          <p class="document-description">Archivo pdf con el proyecto completo.</p>
        </div>
        <button class="download-button">Descargar</button>
      </div>
      <hr>
      <div class="document-item">
        <span class="document-icon"><img src="img/pdf.png"></span> 
        <div class="document-info">
          <p class="document-title">Proyecto completo</p>
          <p class="document-description">Archivo pdf con el proyecto completo.</p>
        </div>
        <button class="download-button">Descargar</button>
      </div>
      
    </section>
  </div>
</div>

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