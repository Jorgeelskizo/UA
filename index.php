<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Universitat d'Alacant</title>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="nav.css">
</head>
<body>

    <?php
    include 'Imports/cabecera.php';
    ?>

<div class="header-image"></div>

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

</body>
</html>
