<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: ../pages_web/page_connexion.php");

?>
