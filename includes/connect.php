<?php
try
{
    $BDD = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8','jean', 'bonjour', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    
}
    catch(Exception $e) {
        die('Erreur fatale : '.$e->getMessage());
    }
    ?>