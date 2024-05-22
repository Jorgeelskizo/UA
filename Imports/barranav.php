<?php
include 'scripts/seleccionarIdioma.php';
?>

<nav class="barranav-nav">
    <label for="checkmenu">&equiv;</label>
    <input type="checkbox" id="checkmenu-nav">
    <ul class="ulbarranav-nav">
        <li class="libarranav-nav"><a href="buscar.php?populares=true" class='icon-home-nav'><span><?php echo $palabras['populares'] ?></span></a></li>
        <li class="libarranav-nav"><a href="buscar.php?tipo=proyecto" class='icon-search-nav'><span><?php echo $palabras['proyect'] ?></span></a></li>
        <li class="libarranav-nav"><a href="buscar.php?tipo=practicas" class="icon-user-add-nav"><span><?php echo $palabras['practic'] ?></span></a></li>
        <li class="libarranav-nav"><a href="buscar.php?tipo=tfg" class="icon-logout-nav"><span><?php echo $palabras['tfg'] ?></span></a></li>
        <li class="libarranav-nav"><a href="buscar.php?tipo=tfm" class="icon-bookmark-nav"><span><?php echo $palabras['tfm'] ?></span></a></li>
    </ul>
</nav>