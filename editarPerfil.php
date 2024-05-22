<?php

include 'scripts/conexion.php';
include 'scripts/controlSesion.php';

if (!isset($_SESSION['id'])) {
    die('No estás autenticado');
}

$id_usuario = $_SESSION['id'];

$sql = "SELECT carrera FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    // Verificar si la contraseña coincide
    
        // Si las credenciales son correctas, establece las variables de sesión
        $carrera = $user['carrera'];

  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Universidad de Alicante - Proyecto Fin de Grado Ingenieria Multimedia</title>
<link rel="stylesheet" href="estilos/stylesEditarPerfil.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

<?php include 'imports/header.php'; ?>

<section class="resumenPerfil">
    
    <!-- <div class="profile-card">
        <div class="profile-photo">
          <img src="img/user.jpg" alt="Nombre Usuario">
        </div>
        <div class="profile-info">
          <p class="profile-name">Nombre Usuario</p>
          <p class="profile-username">Username</p>
          <p class="profile-university">Universidad de Alicante</p>
          <p class="profile-degree">Carrera cursada</p>
        </div>
      </div> -->
</section>

<div class="profile-card-global">
    <h3>Detalles Perfil</h3>
    <hr>
    <div class="profile-card">

        <div class="profile-photo">
        <img src="img/user.jpg" alt="Nombre Usuario">
        </div>
        <div class="profile-info">
        <p class="profile-name">Nombre Usuario</p>
        <p class="profile-username">Username</p>
        <p class="profile-university">Universidad de Alicante</p>
        <p class="profile-degree">Carrera cursada</p>
        </div>
    </div>
</div>

<div class="content-container">
  <div class="left-container">
    <div class="form-container">
      <form action="scripts/update-profile.php" method="POST">
        <div class="form-group">
          <label for="user-name">Nombre Completo</label>
          <input type="text" id="user-name" name="user-name" >
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" >
        </div>
        <div class="form-group">
          <label for="degree">Carrera</label>
            <select id="degree" name="degree">
                <option value="Carrera 1" <?php if($carrera == 'Carrera 1') echo 'selected'; ?>>Carrera 1</option>
                <option value="Carrera 2" <?php if($carrera == 'Carrera 2') echo 'selected'; ?>>Carrera 2</option>
                <option value="Carrera 3" <?php if($carrera == 'Carrera 3') echo 'selected'; ?>>Carrera 3</option>
                <option value="Carrera 4" <?php if($carrera == 'Carrera 4') echo 'selected'; ?>>Carrera 4</option>
                <option value="Carrera 5" <?php if($carrera == 'Carrera 5') echo 'selected'; ?>>Carrera 5</option>
            </select>
        </div>
        <button type="submit" class="form-button">Actualizar</button>
      </form>
    </div>
  </div>

  <div class="right-container">
    <div class="form-container">
      <!-- Profile Image Update Section -->
      <h2 class="section-header">Foto de perfil</h2>
      <p class="upload-instructions">
        La imagen no debe exceder los 20 MB para garantizar una carga eficiente. Además, al subir tu foto, aceptas los términos y condiciones relacionados con los derechos de autor y cualquier otro requisito que pueda surgir.
      </p>
      <form action="scripts/update_profile_photo.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <input type="file" id="profile-photo" name="profile-photo">
        </div>
        <button type="submit" class="form-button">Actualizar</button>
      </form>
    </div>
    
    <div class="form-container">
      <!-- Password Change Section -->
      <h2 class="section-header">Cambiar contraseña</h2>
      <form action="scripts/update_password.php" method="POST">
        <div class="form-group">
          <input type="password" id="new-password" name="new-password" placeholder="Nueva Contraseña">
        </div>
        <div class="form-group">
          <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmar Nueva Contraseña">
        </div>
        <button type="submit" class="form-button">Actualizar</button>
      </form>
    </div>
  </div>
</div>
</div>
  

</body>
</html>