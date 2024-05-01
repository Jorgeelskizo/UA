<?php
include 'scripts/controlSesion.php';


if (isset($_SESSION['nombre_usuario'])) {
  header("Location: index.php"); // Redirige a la página principal si ya está logueado
  exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inicio de Sesión - Universidad de Alicante</title>
<link rel="stylesheet" href="estilos/loginstyles.css">
<link rel="alternate stylesheet" type="text/css" href="estilos/modoscurologin.css" title="DarkMode">
</head>
<body>

<div class="login-container">
  <div class="login-box">
    <img src="path-to-your-logo.png" alt="Universidad de Alicante" class="university-logo">
    <div class="login-title">Iniciar Sesión</div>
    <form method="post" action="scripts/login.php" enctype="multipart/form-data">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Nombre de usuario" name="nombre_completo">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Contraseña" name="contrasena">
      </div>
      <div class="session-utilities">
        <div class="checkbox">
          <label>
            Recordar sesión <input type="checkbox" name="recordar"> 
          </label>
        </div>
        <a href="register.php" class="link">Recuperar contraseña</a>
      </div>
      <div class="form-action">
        <button type="submit" class="btn">Iniciar Sesión</button>
      </div>
      <div class="social-login">
        <a href="#" class="social-icon"><img src="path-to-google-icon.png" alt="Google"></a>
        <a href="#" class="social-icon"><img src="path-to-facebook-icon.png" alt="Facebook"></a>
      </div>
    </form>
  </div>
</div>

</body>
</html>
