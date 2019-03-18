<!DOCTYPE html>
<?php require_once "includes/head.php"; ?>
<body id = "fond_home">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css_login.css">
    <?php
    session_start();
    require_once "includes/header.php";
    require_once "includes/connect.php"; 
    require_once "includes/fonctions.php";
    
    ?>


    <div class = "container">
        <div class ="row justify-content-center">
            <div id="titre_enigme" class = "col-7">
                <h1 id="nom_enigme"> <?php print(queryBDD('title','games','ID_game',$progression)); ?> </h1>
            </div>
        </div>
        <div class = "row justify-content-center">
            <div id ="corps_enigme" class = "col-12">
            <?php 
            
                $IDG = queryBDD('progression', 'scores', 'ID', $_SESSION['id']);
                $typee = queryBDD('TYPE','games','ID_game',$IDG);
                if ($typee == 1 || $typee == 2 && $_GET['reponse']== 'faux');
                {
                    updateBDD('scores','points',queryBDD('points', 'scores', 'ID',$_SESSION['id'] ) + 1000,'ID',$_SESSION['id']);
                    print "c'est faux sale loser!!! Même FatPatBat aurait trouvé sérieux là?!";
                }
                else
                {
                    if ($typee == 0 && $_GET['reponse']== 'faux');
                    {
                        print "faux réessaie encore loleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee(je te hais)eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee";
                    }
                    else
                    {
                        print "c'est bien vu ça. La NASA te remercie ";
                        updateBDD('scores','progression',queryBDD('progression', 'scores','ID', $_SESSION['id']) + 1 ,'ID',$_SESSION['id']);
                    }
                }
                sleep(5);
                header("Location: game.php");
            ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>