<?php

function queryBDD($select, $from, $where, $result)
{
    require "connect.php" ;
    $requete = "select $select from $from where $where = '$result'";
    $res = $BDD -> query($requete);
    $ligne = $res -> fetch();
    $value = $ligne["$select"];
    return $value;
}

function updateBDD($table,$nom_colonne,$nouvelle_valeur,$where,$result)
{
    require "connect.php" ;
    $requete = "UPDATE $table
    SET $nom_colonne = '$nouvelle_valeur'
    WHERE $where ='$result'
    ";
    $BDD -> query($requete);
}