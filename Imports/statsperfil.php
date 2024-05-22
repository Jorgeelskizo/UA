<?php
if (!isset($_SESSION['nombre_usuario']) || $_SESSION['id'] != $_GET['id']) {
  // Si no está establecida, redirigir a la página de login

  // Preparar la consulta para obtener solo el nombre de usuario y la contraseña hasheada
  $query = "SELECT 
  u.nombre_completo, 
  u.contrasena, 
  u.id_usuario, 
  u.foto, 
  COUNT(t.id_trabajo) AS cantidad_trabajos,
  COALESCE(AVG(t.valoracion), 0) AS media_valoraciones
  FROM usuarios u
  LEFT JOIN trabajos t ON u.id_usuario = t.id_usuario
  WHERE u.id_usuario = ?
  GROUP BY u.id_usuario;
";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $id);
  $stmt->execute();
  $result = $stmt->get_result();


  if ($user = $result->fetch_assoc()) {
    // Verificar si la contraseña coincide
    // Si las credenciales son correctas, establece las variables de sesión
    $nombre = $user['nombre_completo'];
    $foto = $user['foto'];
    $cant = $user['cantidad_trabajos'];
    $media = $user['media_valoraciones'];
  }

  $bool = false;
} else {

  $nombre = $_SESSION['nombre_usuario'];
  $foto = $_SESSION['foto'];
  $bool = true;
  $idS = $_GET['id'];

  $query = "SELECT 
  u.nombre_completo, 
  u.contrasena, 
  u.id_usuario, 
  u.foto, 
  COUNT(t.id_trabajo) AS cantidad_trabajos,
  COALESCE(AVG(t.valoracion), 0) AS media_valoraciones
  FROM usuarios u
  LEFT JOIN trabajos t ON u.id_usuario = t.id_usuario
  WHERE u.id_usuario = ?
  GROUP BY u.id_usuario;
";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $idS);
  $stmt->execute();
  $result = $stmt->get_result();


  if ($user = $result->fetch_assoc()) {
    $cant = $user['cantidad_trabajos'];
    $media = $user['media_valoraciones'];
  }
}
?>


<main>
  <section class="profile-noheader-perfil">
    <div class="profile-container-perfil">
      <img src="<?php echo $foto ?>" alt="Foto de perfil" class="profile-image-perfil">
      <?php
      echo  "<h1>$nombre</h1>";
      ?>
      <div class="stats-perfil">
        <div><span>Media de valoraciones</span><br><?php echo $media?></div>
        <div><span>Trabajos publicados</span><br><?php echo $cant ?></div>
      </div>
    </div>
    <?php
    if (basename($_SERVER['SCRIPT_NAME']) != 'perfilpersonal.php') {
    ?>
      <button class="follow-button-perfil">Seguir</button>
    <?php
    }
    else {
    ?>

    <a href="scripts/closeSesion.php">
      <button class="cerrar-sesion">Cerrar Sesión</button>
    </a>
    
    <a href="configuracion.php"">
      <button class="ajustes-perfil">Ajustes</button>
    </a>

    <a href="editarPerfil.php?id=<?php echo $_SESSION['id']; ?>">
      <button class="follow-button-perfil">Editar perfil</button>
    </a>

    <?php
    }
    ?>
  </section>