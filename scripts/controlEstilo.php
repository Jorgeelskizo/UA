<?php 
        if (isset($_SESSION['modo'])) {
            echo '<link rel="stylesheet" href="estilos/unificado' . $_SESSION['modo']. '.css">';
        }
?>