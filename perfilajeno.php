<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Perfil de Usuario - Universitat d'Alacant</title>
<link rel="stylesheet" href="perfilajeno.css">
</head>
<body>

<?php
    include 'Imports/cabecera.php';
?>

<main>
  <section class="profile-noheader">
    <div class="profile-container">
      <img src="Imagenes/hung_360.png" alt="Foto de perfil" class="profile-image">
      <h1>Nombre</h1>
      <div class="stats">
        <div><span>Likes dados</span><br>123</div>
        <div><span>Likes recibidos</span><br>456</div>
        <div><span>Trabajos publicados</span><br>9</div>
      </div>
    </div>
    <button class="follow-button">Seguir</button>
  </section>

  <nav>
    <ul>
      <li>Populares</li>
      <li>Proyectos</li>
      <li>Prácticas</li>
      <li>TFG</li>
      <li>TFM</li>
    </ul>
  </nav>

  <section class="gallery-container">
    <section class="project-gallery">
        <article>
            <img src="Imagenes/bardosbattle.PNG" alt="Proyecto 1">
            <footer>
                <p>Daniela</p>
                <p>Fecha</p>
            </footer>
        </article>
        <article>
            <img src="Imagenes/hung_360.png" alt="Proyecto 2">
            <footer>
                <p>Daniela</p>
                <p>Fecha</p>
            </footer>
        </article>
        <article>
            <img src="Imagenes/biblio.jpg" alt="Proyecto 3">
            <footer>
                <p>Daniela</p>
                <p>Fecha</p>
            </footer>
        </article>
        <article>
            <img src="Imagenes/libro2.jpg" alt="Proyecto 4">
            <footer>
                <p>Daniela</p>
                <p>Fecha</p>
            </footer>         
        </article>
    </section>

    <div>
        <button>Ver más</button>
    </div>
</section>
</main>

</body>
</html>
