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
    <title>Registro Universidad de Alicante</title>
    <link rel="stylesheet" href="estilos/unificado.css">
    <link rel="alternate stylesheet" href="estilos/modooscuroregister.css" title="DarkMode">
    <!-- Añade más enlaces a hojas de estilo si es necesario -->
</head>
<body>
    <div class="registro-container-register">
        <div class="registro-box-register">
            <div class="university-logo-register">
                <!-- Incluir la imagen del logo aquí -->
            </div>
            <h2 class="registro-title-register">Registro</h2>
            <form class="registro-form-register" action="scripts/registro.php" method="POST" enctype="multipart/form-data">
                <div class="form-group-register">
                    <input type="text" class="form-control-register" placeholder="Nombre Completo" name="nombre_completo">
                </div>
                <div class="form-group-register">
                    <input type="text" class="form-control-register" placeholder="Nick" name="nick">
                </div>
                <!-- <div class="form-group">
                    <input type="text" class="form-control" placeholder="DNI">
                </div> -->
                <div class="form-group-register">
                    <input type="date" class="form-control-register" name="fecha">
                    <select class="form-control-register" name="carrera">
                        <option>Carrera 1</option>
                        <option>carrera 2</option>
                        <option>Carrera 3</option>
                        <option>Carrera 4</option>
                        <option>Carrera 5</option>
                    </select>
                    <select class="form-control-register" name="anyo">
                        <option>Año</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
                <div class="form-group-register">
                    <input type="email" class="form-control-register" placeholder="Email" name="correo_electronico">
                </div>
                <div class="form-group-register">
                    <input type="password" class="form-control-register" placeholder="Contraseña" name="contrasena">
                    <input type="password" class="form-control-register" placeholder="Repetir contraseña">
                </div>
                <div class="form-group-register">
                    <!-- <label for="foto">Foto de Perfil:</label> -->
                    <input type="file" class="form-control-register" id="foto" name="foto">
                </div>
                <div class="form-actions-register">
                    <button type="button" class="btn cancelar">Cancelar</button>
                    <button type="submit" class="btn registrar">Registrar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Aquí podrías añadir un pequeño JavaScript para cambiar entre los estilos claro y oscuro -->
</body>
</html>
