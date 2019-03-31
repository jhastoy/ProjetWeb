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
function insertEnigme1($title, $body, $type)
{
    $title = str_replace("'","\'",$title);
    $body = str_replace("'","\'",$body);
    
    require "connect.php" ;
    $ID_games = nombreGames() + 1;
    $requete = "insert into games (TITLE, BODY, TYPE, ID_game) values ('$title','$body',$type,$ID_games)"; 
    $BDD -> query($requete);
}
function uploadImage($array,$directory,$filename1,$filename2)
{
    $uploaddir = "$directory/";
    $uploadfile1 = $uploaddir.basename($array["$filename1"]['name']);  
    $uploadfile2 = $uploaddir.basename($array["$filename2"]['name']);  
    $fichier1 = basename($array["$filename1"]['name']);
    $fichier2 = basename($array["$filename2"]['name']);
    // $taille_maxi = 10000000000;
    
    // $taille = filesize($array["$filename"]['tmp_name']);
    /* if($filename = 'fond')
    {
        $extensions = array('.png');
    }
    else
    {
        $extensions = array('.png', '.mp3', '.mp4');
    }
    */
    $extension1 = strrchr($array["$filename1"]['name'], '.'); 
    $extension2 = strrchr($array["$filename2"]['name'], '.'); 
    
    $array1[0] = $fichier1;
    $array1[1] = $extension1;
    $array1[2] = $fichier2;

    
    //Début des vérifications de sécurité...
    /* if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
        $erreur = 'Vous devez uploader un fichier de type png pour une image, mp3 pour un son, ou mp4 pour une vidéo.';
    }
    */
    // if($taille>$taille_maxi)
    // {
    //     $erreur = 'Le fichier est trop gros...';
    // }
    if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
        //On formate le nom du fichier ici...
        $fichier1 = strtr($fichier1, 
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $fichier1 = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier1);
        $fichier2 = strtr($fichier2, 
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $fichier2 = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier2);
        if(move_uploaded_file($array["$filename1"]['tmp_name'], $uploadfile1) && move_uploaded_file($array["$filename2"]['tmp_name'], $uploadfile2)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
            echo 'Upload effectué avec succès !';
        }
        else //Sinon (la fonction renvoie FALSE).
        {
            echo 'Echec de l\'upload !';
        }
    }
    else
    {
        echo $erreur;
    }
    return $array1;
}

function arrayPlayers()
{
    require "connect.php" ;
    $nb = nombreGames();
    $requete = "select ID,points from scores where progression = $nb order by points asc ";
    $res = $BDD -> query($requete);
    $tab = $res -> fetchAll();
    return $tab;
}
function nb_joueurs_fpb()
{
    require "connect.php" ;
    $nb = nombreGames();
    $requete = "select COUNT(ID) as nb from scores where progression = $nb";
    $res = $BDD -> query($requete);
    $ligne = $res -> fetch();
    $value = $ligne["nb"];
    return $value;
}
function place_classement($id)
{
    require "connect.php" ;
    $points = queryBDD('points','scores','ID',$id);
    $requete = " SELECT COUNT(*) AS nb1 FROM scores WHERE points <= $points ";
    $res = $BDD -> query($requete);
    $ligne = $res -> fetch();
    $value = $ligne["nb1"];
    return $value;
}

