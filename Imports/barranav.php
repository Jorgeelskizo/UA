<?php
if( isset( $_SESSION['lang'])){
    $idioma = $_SESSION['lang'];
}else{
    $idioma = 'in';
}

$palabras = parse_ini_file( "idiomas/$idioma.ini");
?>


<nav class="barranav-nav">
		<label for="checkmenu">&equiv;</label>
		<input type="checkbox" id="checkmenu-nav">
		<ul class="ulbarranav-nav">
			<li class="libarranav-nav"><a href="index.html" class='icon-home-nav'><span><?php echo $palabras['populares'] ?></span></a></li>
			<li class="libarranav-nav"><a href="buscar.php" class='icon-search-nav'><span><?php echo $palabras['proyect'] ?></a></li>
			<li class="libarranav-nav"><a href="login.html" class="icon-user-add-nav"><span><?php echo $palabras['practic'] ?></span></a></li>
			<li class="libarranav-nav"><a href="scripts/closeSesion.php" class="icon-logout-nav"><span><?php echo $palabras['tfg'] ?></span></a></li>
			<li class="libarranav-nav"><a href="registro.html" class="icon-bookmark-nav"><span><?php echo $palabras['tfm'] ?></span></a></li>
		</ul>
</nav>