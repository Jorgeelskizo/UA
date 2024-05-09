<?php
if (!isset($_SESSION['nombre_usuario']) || $_SESSION['id'] != $_GET['id']) {
  // Si no está establecida, redirigir a la página de login

  // Preparar la consulta para obtener solo el nombre de usuario y la contraseña hasheada
  $query = "SELECT nombre_completo, contrasena, id_usuario, foto FROM usuarios WHERE id_usuario = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $id);
  $stmt->execute();
  $result = $stmt->get_result();


  if ($user = $result->fetch_assoc()) {
      // Verificar si la contraseña coincide
          // Si las credenciales son correctas, establece las variables de sesión
          $nombre = $user['nombre_completo'];
          $foto = $user['foto'];
    }

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
          echo  "<h1>$nombre</h1>";
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