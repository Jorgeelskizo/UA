<?php
session_start();

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
    <link rel="stylesheet" href="registerstylo.css">
    <link rel="alternate stylesheet" href="modooscuroregister.css" title="DarkMode">
    <!-- Añade más enlaces a hojas de estilo si es necesario -->
</head>
<body>
    <div class="registro-container">
        <div class="registro-box">
            <div class="university-logo">
                <!-- Incluir la imagen del logo aquí -->
            </div>
            <h2 class="registro-title">Registro</h2>
            <form class="registro-form" action="scripts/registro.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nombre Completo" name="nombre_completo">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nick" name="nick">
                </div>
                <!-- <div class="form-group">
                    <input type="text" class="form-control" placeholder="DNI">
                </div> -->
                <div class="form-group">
                    <input type="date" class="form-control" name="fecha">
                    <select class="form-control" name="carrera">
                        <option>Carrera 1</option>
                        <option>carrera 2</option>
                        <option>Carrera 3</option>
                        <option>Carrera 4</option>
                        <option>Carrera 5</option>
                    </select>
                    <select class="form-control" name="anyo">
                        <option>Año</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" name="correo_electronico">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Contraseña" name="contrasena">
                    <input type="password" class="form-control" placeholder="Repetir contraseña">
                </div>
                <div class="form-group">
                    <!-- <label for="foto">Foto de Perfil:</label> -->
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
                <div class="form-actions">
                    <button type="button" class="btn cancelar">Cancelar</button>
                    <button type="submit" class="btn registrar">Registrar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Aquí podrías añadir un pequeño JavaScript para cambiar entre los estilos claro y oscuro -->
</body>
</html>
