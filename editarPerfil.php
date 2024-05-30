<?php

include 'scripts/conexion.php';
include 'scripts/controlSesion.php';

if (!isset($_SESSION['id'])) {
    die('No estás autenticado');
}

$id_usuario = $_SESSION['id'];

$sql = "SELECT nombre_completo, carrera, foto, nick FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    // Verificar si la contraseña coincide
    
        // Si las credenciales son correctas, establece las variables de sesión
        $carrera = $user['carrera'];
        $imagen = $user['foto'];
        $nick = $user['nick'];
        $carrera = $user['carrera'];
        $nombre = $user['nombre_completo'];

  }



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Universidad de Alicante - Proyecto Fin de Grado Ingenieria Multimedia</title>
<link rel="stylesheet" href="estilos/unificado.css">
<link rel="stylesheet" href="imports/fontello/css/fontello.css">
<?php include 'scripts/controlEstilo.php'; ?>
<?php include 'scripts/controlTamano.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .form-group img {
        width: 150px; /* Ajusta según tu necesidad */
        height: 150px; /* Ajusta según tu necesidad */
        cursor: pointer;
        border-radius: 50%;
        object-fit: cover;
    }

    #profile-photo-input {
        display: none;
    }
</style>

</head>
<body>

<?php
    include 'Imports/header.php';
    ?>

    <div class="header-image-index"></div>

    <?php
    include 'Imports/barranav.php';
    ?>


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
          <div class="imagen-perfil">
            <img src="<?php echo $imagen?>" alt="Nombre Usuario">
          </div>
        </div>
        <div class="profile-info">
        <p class="profile-name"><?php echo $nombre?></p>
        <p class="profile-username"><?php echo $nick?></p>
        <p class="profile-university">Universidad de Alicante</p>
        <p class="profile-degree"><?php echo $carrera?></p>
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
      <form action="scripts/update_profile_foto.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <input type="file" id="profile-photo-input" name="profile-photo" accept="image/*">
          <img src="<?php echo $imagen ?>" alt="Foto de perfil" id="profile-photo-preview" onclick="document.getElementById('profile-photo-input').click();">
        </div>
        <button type="submit" class="form-button">Actualizar</button>
      </form>
    </div>
    
    <div class="form-container">
        <!-- Password Change Section -->
        <h2 class="section-header">Cambiar contraseña</h2>
        <form id="password-form" action="scripts/update-password.php" method="POST">
            <div class="form-group">
                <input type="password" id="new-password" name="new-password" placeholder="Nueva Contraseña" required>
            </div>
            <div class="form-group">
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmar Nueva Contraseña" required>
            </div>
            <button type="submit" class="form-button">Actualizar</button>
        </form>
        <div id="error-message" style="color: red;"></div>
        <div id="success-message" style="color: green;"></div>
    </div>

    <script>
    document.getElementById('password-form').addEventListener('submit', function(event) {
        var newPassword = document.getElementById('new-password').value;
        var confirmPassword = document.getElementById('confirm-password').value;
        var errorMessage = document.getElementById('error-message');
        var successMessage = document.getElementById('success-message');

        errorMessage.textContent = '';
        successMessage.textContent = '';

        if (newPassword !== confirmPassword) {
            event.preventDefault();
            errorMessage.textContent = 'Las contraseñas no coinciden.' ;
        }
        
        if (newPassword.length < 5) { // Por ejemplo, mínimo 6 caracteres
            event.preventDefault();
            errorMessage.textContent = 'La nueva contraseña debe tener al menos 5 caracteres';
        }
    });

    // Mostrar mensajes desde el servidor
    window.onload = function() {
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            document.getElementById('error-message').textContent = urlParams.get('error');
        }
        if (urlParams.has('success')) {
            document.getElementById('success-message').textContent = urlParams.get('success');
        }
    }

    document.getElementById('profile-photo-input').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('profile-photo-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
    </script>

  </div>
</div>
</div>
  

</body>
</html>
