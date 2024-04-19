
<?php
$nombre = $_SESSION['nombre_usuario'];
?>


<header class="site-header">
    <div class="logo">
        <img src="img/logoUA.png" alt="Logo" class="logo-big">
        <img src="img/ua-cuadrado.png" alt="Logo" class="logo-small">
    </div>
    <div class="search-bar">
        <input type="text">
        <button type="submit" class="search-button">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <div class="profile">
        <span class="user-name"><?php $nombre ?></span>
        <img src="img/user.jpg" alt="Profile Picture">
    </div>
</header>