<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Universidad de Alicante - Proyecto Fin de Grado Ingenieria Multimedia</title>
<link rel="stylesheet" href="estilos/editar_proyecto.css">
<link rel="stylesheet" href="estilos/styleheader.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script src="scripts/editarproyecto.js"></script>

</head>
<body>

  <?php include "imports/header.php"?>
  <h1 id="titulo">Edita tu proyecto</h1>
<div class="project-container">
  
  <div class="left-column">
  <h2 id="titulo">Imagen del proyecto</h2>
  <div class="project-image">
    <img src="img/pasoPeatones.jpg" alt="Project Thumbnail">
    <!-- Botón para cambiar la imagen -->
    <button class="change-image-btn">Cambiar Imagen</button>
</div>

    <div class="project-info">
        <div class="project-meta">
            <p class="author">Hecho por <span class="author-name">Nombre del Autor</span></p>
            <p class="time-ago">1 hour 13 minutes</p>
            <p class="rating">Rated 5.0/5.0</p>
        </div>

        <h2 id="titulo">Titulo del proyecto</h2>
                <input id="input_titulo" type="text"  value="Titulo Proyecto">

                <h2 id="titulo">Descripción del proyecto</h2>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10">Descripción del proyecto</textarea>
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