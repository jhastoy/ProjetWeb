<!DOCTYPE html>
<?php session_start(); require_once "includes/head.php"; ?>
<body style='background: url(images/<?php if($_SESSION['victoire']) print'david.jpg'; else print'patrick.jpg'; ?>) no-repeat; width: 100%; height: 150px; background-size: 100%;'>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="css_login.css">
<?php

require_once "includes/header.php";
require_once "includes/fonctions.php";

?>
<?php
    if($_SESSION['victoire'])
    {
        ?>
        <div class = "row justify-content-center">
            <div class='col-8' id='end'>
                <div class = "row justify-content-center">
                    <h1 class = 'titre_home'> <strong>Felicitations !</strong>  </h1>

                </div>
                <div class = "row justify-content-center">
                    <div class = "col-8">
                        <p>
                        Wow. Après son expérience à travers le temps m, Patrick a quitté la batterie pour se reconvertir aux platines. Il a su apporter un nouveau courant dont seul lui a le secret que les puristes appellent l'electropat. Si il arrive à toucher un grand public avec des chansons paraissant populaires, les professionnels le qualifient de génie de par les nombreuses subtilités cachées dans sa musique. Son épouse est Keira Knightley et sa fille adoptive est asiatique mais personne ne saura jamais pourquoi on vous dit ça. Tu as fait de lui ce que l'on appelle de lui un "sacré bonhomme", Félicitations !
                        </p>
                    </div>
                </div>
                <div class = "row justify-content-around">
                    <div class = "col-4">
                        <h1 class ='titre_home'>
                            Ton classement : 
                        </h1>
                    </div>
                    <div class = "col-4">
                        <h1 class ='titre_home'>
                            Ton score : 
                        </h1>
                    </div>
                </div>
                <div class = "row justify-content-around">
                    <div id = "classement" class = "col-2">
                        <p class = "infos"> <?php print place_classement($_SESSION['id']); ?> </p>
                    </div>
                    <div id = "scores1" class = "col-2">
                        <p  class = "infos"> <?php print queryBDD('points', 'scores', 'ID', $_SESSION['id']); ?> </p>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
    else
    { ?>
        <div class = "row justify-content-center">
            <div class='col-8' id='end'>
                <div class = "row justify-content-center">
                    <h1 id = 'titre_home'> Loooser ! </h1>

                </div>
                <div class = "row justify-content-center">
                    <div class = "col-8">
                        <p>
                        Tu as aidé fatpatbat à devenir quelqu'un : un beauf. Pat s'est reconverti dans la musique campagnarde et a écrit des chansons telles que "Les sardines" . Si Patrick ne chante pas, il devient un homme meilleur mais l'appat du gain et la vente de son âme au diable le font chanter chaque jour que dieu fait. Ses parents sont morts d'une nouvelle tumeur aux tympans apparue pour la première fois chez eux. Félicitations, car tu es le responsable !!!!
                        </p>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>







    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

