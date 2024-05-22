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
<link rel="stylesheet" href="estilos/unificado.css">
<?php include 'scripts/controlEstilo.php'; ?>

</head>
<body>

<div class="login-container-login">
  <div class="login-box-login">
    <img src="path-to-your-logo.png" alt="Universidad de Alicante" class="university-logo-login">
    <div class="login-title-login">Iniciar Sesión</div>
    <form method="post" action="scripts/login.php" enctype="multipart/form-data">
      <div class="form-group-login">
        <input type="text" class="form-control-login" placeholder="Nombre de usuario" name="nombre_completo">
      </div>
      <div class="form-group-login">
        <input type="password" class="form-control-login" placeholder="Contraseña" name="contrasena">
      </div>
      <div class="session-utilities-login">
        <div class="checkbox-login">
          <label>
            Recordar sesión <input type="checkbox" name="recordar"> 
          </label>
        </div>
        <a href="register.php" class="link-login">Recuperar contraseña</a>
      </div>
      <div class="form-action">
        <button type="submit" class="btn-login">Iniciar Sesión</button>
      </div>
      <div class="social-login-login">
        <a href="#" class="social-icon"><img src="path-to-google-icon.png" alt="Google"></a>
        <a href="#" class="social-icon"><img src="path-to-facebook-icon.png" alt="Facebook"></a>
      </div>
    </form>
  </div>
</div>

</body>
</html>
