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