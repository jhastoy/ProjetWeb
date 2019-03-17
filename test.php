<!DOCTYPE html>
<?php require_once "includes/head.php"; ?>


<body id = "fond_home">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="CSS_login.css">
<?php
session_start();
require_once "includes/header.php";
require_once "includes/connect.php" ?>

<div id = "fond_page">
    <div class = "row justify-content-between">
        <div class="col-3" id="nouv_partie">
            <h1 class = "titre_home">Nouvelle parti'tion</h1>
            <div id = "nouv_partie2_1" class = "row justify-content-center">
                <div class = "col-10" id = "nouv_partie2">
                <p> Introduction au jeu </p>
                </div>
            </div>
            <div class = "row justify-content-center">
                
                <div class = "col-4">
                <button class="btn btn-dark" style="text-align:center" type="submit">Règles</button>
                </div>
                <div class = "col-6">
                <a href = "create_team.php"><button id = 'play' class='btn btn-dark' style='text-align:center' type='submit'>Lancer partie</button></a>
                </div>
                
            </div>
        </div>

        <?php require_once "includes/fonctions.php";
        $ligne = queryBDD("progression","scores", "id", $id);
        if($ligne ==0)
        {
            echo "
            <div class='col-5' id='progression'>
            <h1 class = 'titre_home'>Progression</h1>
            <div id='progression2'>
            <div class = 'row justify-content-around'>
                <div class = 'col-2'>
                    <img id = 'drum' src='images/drum_v1.png' alt ='drum' height ='120' width = '120' >
                </div>
                <div class = 'col-8'>
                    <p class = 'texte_nouv_part'> Tu n'as pas encore créé de partie!<br/> Réunis tes amis et venez tous ensemble découvrir l'histoire de la musique à travers différentes époques ! </p>
                </div>
                
                
            </div>
            </div>
        </div>"
            ;
        }
        else
        {
            echo "donne moi de l'argent stp";
        }
        
            
        ?>
        <div class="col-2" id="scores">
        <h1 class = "titre_home">Top fatbat'ers</h1>
        </div>
    </div>
</div>





    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>