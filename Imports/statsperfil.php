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
    <?php 
            if (basename($_SERVER['SCRIPT_NAME']) != 'perfilpersonal.php') {    
        ?>
                <button class="follow-button">Seguir</button>
        <?php 
            }
        ?>    
  </section>