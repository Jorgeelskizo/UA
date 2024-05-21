<?php
$_SESSION['lang'] = $_GET['l'] ?? 'es';
header( "Location: /" );
?>