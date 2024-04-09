<header class="site-header">
        <div class="logo">
            <img src="Imagenes/hung_360.png" alt="Universitat d'Alacant Logo">
        </div>
        <div class="search-bar">
            <input type="text">
            <button type="submit" class="search-button">
                <i class="fas fa-search"></i>
              </button>
        </div>
        <?php 
            if (basename($_SERVER['SCRIPT_NAME']) != 'perfilpersonal.php') {
                // Código para mostrar el div de perfil        
        ?>
                <div class="profile">
                    <img src="Imagenes/hung_360.png" alt="Profile Picture">
                </div>
        <?php 
            }else{
        ?>
                <div class="profile">
                    <i class="fa-solid fa-gear"></i>
                </div>
        <?php                     
              } 
        ?>
             
         
        
    </header>