<?php 
if( isset( $_SESSION['lang'])){
    $idioma = $_SESSION['lang'];
}else{
    $idioma = 'in';
}

$palabras = parse_ini_file( "configs/$idioma.ini");
?>