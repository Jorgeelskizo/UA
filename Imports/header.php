<?php
// Comprobar si la variable de sesión 'usuario_id' está establecida
if (!isset($_SESSION['nombre_usuario'])) {
    // Si no está establecida, redirigir a la página de login
    $nombre = '';
    $bool = false;
} else {
        $nombre = $_SESSION['nombre_usuario'];
        $foto = $_SESSION['foto'];
        $idH = $_SESSION['id'];
        $bool = true;
}

?>


<header class="site-header">
    <div class="logo">
        <a class="logo" href="index.php">
            <img src="img/logoUA.png" alt="Logo" class="logo-big">
            <img src="img/ua-cuadrado.png" alt="Logo" class="logo-small">
        </a>

    </div>
    <div class="search-bar">
        <input type="text">
        <button type="submit" class="search-button">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <div class="profile">
        <?php
        // Comprobar si la variable de sesión 'usuario_id' está establecida
        if ($bool == false) {
            // Mostrar botones de iniciar sesión y registrarse
            echo "<button type='button' onclick='location.href=\"login-form.php\"'>Iniciar sesión</button>";
            echo "<button type='button' onclick='location.href=\"register.php\"'>Registrarse</button>";
        } else {
            // Mostrar nombre de usuario y foto
            echo "<a href='perfilpersonal.php?id=$idH' class='profile' style='text-decoration: none; color: inherit;'>";
            echo "<span class='user-name'>" . htmlspecialchars($nombre) . "</span>";
            echo "<img src=" . $foto . " alt='Profile Picture'>";
            echo "</a>";
            echo "<button type='button' onclick='location.href=\"publicar_proyecto.php\"'>Publicar proyecto</button>";
        }

        ?>

    </div>
</header>