<?php
include 'scripts/controlSesion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Perfil de Usuario - Universitat d'Alacant</title>
<link rel="stylesheet" href="estilos/perfilajeno.css">
<link rel="stylesheet" href="estilos/nav.css">
<link rel="stylesheet" href="estilos/styleheader.css">
</head>
<body>

<?php
    include 'Imports/header.php';
?>

<?php
    include 'Imports/statsperfil.php';
?>

  <?php
        include 'Imports/barranav.php';
  ?>

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
