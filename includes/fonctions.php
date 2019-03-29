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
function querylisteBDD($select, $from, $where, $result)
{
    require "connect.php" ;
    $requete = "select $select from $from where $where = '$result'";
    $res = $BDD -> query($requete);
    $ligne = $res -> fetch();
    return $ligne;
}

function ajoutpoints ($time,$id_joueur)
{
    require "connect.php" ;
    $points = queryBDD('points','scores','ID',$id_joueur);
    $time_tot = queryBDD('time','scores','ID',$id_joueur);
    $nb_heures = $time -> format('%H');
    $nb_min = $time -> format('%I');
    $nb_sec = $time -> format('%S'); 
    $time3= date("H:i:s", strtotime("+ $nb_heures hour, + $nb_min minute, + $nb_sec second ", strtotime($time_tot)));
    print '......'.$time3;
    $requete = "UPDATE `scores` SET `time` = '$time3' ,`points`= $points + 60*60*$nb_heures + 60*$nb_min+$nb_sec WHERE `ID`= '$id_joueur'" ;
    $BDD -> query($requete);
}

function updateBDD($table,$nom_colonne,$nouvelle_valeur,$where,$result)
{
    require "connect.php" ;
    $requete = "UPDATE $table
    SET $nom_colonne = '$nouvelle_valeur'
    WHERE $where ='$result'";
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

