<?php
include 'scripts/controlSesion.php';


if (isset($_SESSION['nombre_usuario'])) {
  header("Location: index.php"); // Redirige a la página principal si ya está logueado
  exit();
}
?>

<?php if (!empty($_SESSION['error'])): ?>
<script>alert('<?php echo $_SESSION['error']; ?>');</script>
<?php unset($_SESSION['error']); endif; ?>


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
    <img src="img/ua-cuadrado.png" alt="Universidad de Alicante" class="university-logo-login">
    <div class="login-title-login">Iniciar Sesión</div>
    <form method="post" action="scripts/login.php" enctype="multipart/form-data">
      <div class="form-group-login">
        <input type="text" class="form-control-login" placeholder="Nombre de usuario" name="nombre_completo" required>
      </div>
      <div class="form-group-login">
        <input type="password" class="form-control-login" placeholder="Contraseña" name="contrasena" required> 
      </div>
      <div class="session-utilities-login">
        <div class="checkbox-login">
          <label>
            Recordar sesión <input type="checkbox" name="recordar"> 
          </label>
        </div>
        <a href="register.php" class="link-login">Registrarme</a>
      </div>
      <div class="form-action">
        <button type="submit" class="btn-login">Iniciar Sesión</button>
      </div>
    </form>
    <div class="form-action">
        <a href="index.php" accesskey='i'><button type="submit" class="btn-login-atras">Volver</button></a>
    </div>
    <div class="social-login-login">
        <a href="#" class="social-icon"><img src="img/google.png" alt="Google"></a>
        <a href="#" class="social-icon"><img src="img/fb.png" alt="Facebook"></a>
      </div>
  </div>
</div>

</body>
</html>
