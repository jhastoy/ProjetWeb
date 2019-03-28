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


function nombreParties()
{
    require "connect.php" ;
    $requete = "SELECT COUNT(`ID`) AS nb FROM `scores` WHERE `progression`!= (SELECT COUNT(*) FROM `games`) and `progression`!=0" ;
    $res = $BDD -> query($requete);
    $ligne = $res -> fetch();
    $value = $ligne["nb"];
    return $value;
    
}

function nombreGames()
{
    require "connect.php" ;
    $requete = "SELECT COUNT(`ID_game`) AS nb FROM `games`";
    $res = $BDD -> query($requete);
    $ligne = $res -> fetch();
    $value = $ligne["nb"];
    return $value;
}
function nombreMessages($id)
{
    require "connect.php" ;
    $requete = "SELECT COUNT(*) AS nb FROM `chat` where ID = '$id'";
    $res = $BDD -> query($requete);
    $ligne = $res -> fetch();
    $value = $ligne["nb"];
    return $value;
}

function infosParties()
{
    require "connect.php" ;
    
    $requete = "SELECT * FROM `scores` WHERE `progression`!= (SELECT COUNT(*) FROM `games`) and `progression`!=0" ;
    $res = $BDD -> query($requete);
    $info = $res -> fetchAll();
    return $info;
}

function infosMessages($id)
{
    require "connect.php" ;
    
    $requete = "SELECT * FROM `chat` WHERE ID = '$id'" ;
    $res = $BDD -> query($requete);
    $info = $res -> fetchAll();
    return $info;

}

function sendChat($id, $message)
{
    require "connect.php" ;
    $requete = "INSERT INTO `chat`(`ID`, `message`) VALUES ('$id','$message')";
    $BDD -> query($requete);
}
