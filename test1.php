<?php
session_start();
require_once "includes/connect.php";
require_once "includes/fonctions.php";
$tab = infosParties();
print($tab[1]['ID']);
?>

