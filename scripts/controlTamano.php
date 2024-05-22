<?php 
        if (isset($_SESSION['tam'])) {
            echo '<link rel="stylesheet" href="estilos/tamano' . $_SESSION['tam']. '.css">';
        }
?>