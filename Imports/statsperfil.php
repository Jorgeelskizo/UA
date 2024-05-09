<?php
if (!isset($_SESSION['nombre_usuario'])) {
  // Si no está establecida, redirigir a la página de login
  $nombre = '';
  $bool = false;
} else {
  $nombre = $_SESSION['nombre_usuario'];
  $foto = $_SESSION['foto'];
  $bool = true;
}
?>


<main>
  <section class="profile-noheader">
    <div class="profile-container">
      <img src="<?php echo $foto ?>" alt="Foto de perfil" class="profile-image">
      <?php 
            if (basename($_SERVER['SCRIPT_NAME']) != 'perfilpersonal.php') {    
              echo  "<h1>Nombre</h1>";
            }else{
              echo  "<h1>$nombre</h1>";
            }
        ?> 
      <div class="stats">
        <div><span>Likes dados</span><br>123</div>
        <div><span>Likes recibidos</span><br>456</div>
        <div><span>Trabajos publicados</span><br>9</div>
      </div>
    </div>
    <?php 
            if (basename($_SERVER['SCRIPT_NAME']) != 'perfilpersonal.php') {    
        ?>
                <button class="follow-button">Seguir</button>
        <?php 
            }
        ?>    
  </section>