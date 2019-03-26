<!DOCTYPE html>
<?php require_once "includes/head.php";?>


<body id = "fond_home">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="CSS_login.css">
    <?php
        session_start();
        require_once "includes/header.php";
    ?>

    <div class = "row justify-content-center">
        <div id = "team" class = "col-2">
            <h1 class = "titre_home">Creer son equipe </h1>
            <p> Tous réunis pour sauver le FatBat'Bat ! Augmentez vos chances en jouant à plusieurs. </p>
        </div>

        
        

        <div id = "team" class = "col-2">
            <div id = "card_team" class = "card card-body text-white">
                <form method = "POST" action = 
                <?php if(!empty($_POST['joueur1']))
                {
                    print("game.php");
                }
                else
                {
                    print("create_team.php");
                }
                ?> >
                    <div class="form-group">
                        <?php  require "includes/connect.php";
                        if (!empty($_POST['nbPlayers']))
                        {
                            for($i = 1; $i<=$_POST['nbPlayers']; $i++)
                            {
                                ?><label>Joueur <?php echo $i; ?></label>
                                <input id = "input_team" name = <?php print "joueur$i"?> type="id" class="form-control"  placeholder="Entrer identififiant" required>
                                <?php 
                            }
                        }
                        
                        else
                        {
                            if(!empty($_POST['joueur1']))
                            {
                                for($i = 1; $i <= sizeof($_POST) ;$i++)
                                {
                                    $value = $_POST["joueur$i"];
                                    $id = $_SESSION['id'];
                                    $Requete = "UPDATE teams SET joueur$i = '$value' WHERE id = '$id'";                                  
                                    $BDD -> query($Requete);
                                }

                            }
                            else
                            {
                            ?>
                                    <label>Nombre de joueurs :</label>
                                    <select name = "nbPlayers" class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    </select>
                            <?php
                            }
                        }
                    
                        ?>
                    <br/>
                    <button type="submit" class="btn btn-dark">Valider</button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>