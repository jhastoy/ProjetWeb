<!DOCTYPE html>
<?php require_once "includes/head.php"; ?>


<body id = "fond_home">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="CSS_login.css">
<?php
session_start();
require_once "includes/header.php";
require_once "includes/connect.php";
require_once "includes/fonctions.php"; ?>
<?php 
if (!empty($_POST['message']))
{
    sendChat($_SESSION['chatuser'], $_POST['message']);
    updateBDD('users','HELP',false,'ID',$_SESSION['chatuser']);
    header('Location: test.php');
}
if (queryBDD('ADMIN', 'users', 'ID', $_SESSION['id']) == 0)
{ ?>
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
                ?>
                <div class = 'col-6' id ="partie_actu">
                    <div class= "row justify-content-center">
                        <div class='col-12' id='progression'>
                            <h1 class = 'titre_home'>Progression</h1>
                            <div id='progression2'>
                                <div class = "row justify-content-between">
                                    <div class = "col-3">
                                        <img id = "img" src = "images/enigme1.jpg" width= "150px" height = "150px"/>
                                    </div>
                                    <div class = "col-7">
                                            <?php
                                            $tab = querylisteBDD('ID,progression,time,points', 'scores', 'ID', $_SESSION['id']);
                                            print "<h2><strong> Temps : </strong>".$tab["time"]."</h2>";
                                            print"<h2>   <strong>Score : </strong>".$tab["points"]."</h2>";
                                            print "<h2> <strong>    Acte </strong>".$tab['progression']."</h2>";
                                            $progression=$tab['progression']/nombreGames()*100;
                                            ?>
                                    </div>
                                </div>     
                                <div class = "row justify-content-center">
                                    <div class = "col-12">
                                        <div class="progress" style="height:10px">
                                            <div class='progress-bar <?php if($progression<=25){print"bg-danger";}else{if($progression>25 && $progression<= 50){print"bg-warning";}else{if($progression>50 && $progression<=75){print"bg-info";}else{print"bg-sucess";}}}?>' role="progressbar" style="height:10px ; width: <?php print($progression) ?>% " aria-valuenow= "<?php print($progression) ?>"  aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>           
                            <div class = "row justify-content-center">
                                <div class = "col-12 text-center" id="reprise">
                                    <a href = "game.php" id="couleur_lien" > reprends ta partie!!! </a>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            }

            
        
        <div class="col-2" id="scores">
        <h1 class = "titre_home">Top fatbat'ers</h1>
        </div>
    </div>
</div>
<?php 
}
}
else
{
?>
    <div id = "fond_page">
        <div class = "row justify-content-between">
            <div class = "col-4" id = "part_act">
                <h1 class = "titre_home">Les parties en cours </h1>
                <div class = 'row justify-content-center'>
                    <div id ="part_act2" class= "col-12" >
                        
                        <?php $tab = infosParties(); 
                        for ($i = 0; $i < nombreparties(); $i++ )
                        {
                            ?>
                            <div class = 'row justify-content-center'>
                                <a href = "test.php?chatuser=<?php print($tab[$i]['ID']); ?>"><div  class = 'col-11' id = '<?php 
                                
                                if(queryBDD('HELP', 'users', 'ID', $tab[$i]['ID'])==true)
                                {
                                    print"rect_av_red";
                                }
                                else
                                {
                                    print"rect_av";
                                }
                                ?>'>
                                
                                  
                                    <div class = "row justify-content-between">
                                        <div class = "col-3">
                                            <img id = "img" src = "images/enigme1.jpg" width= "100px"/>
                                        </div>
                                        <div class = "col-9">
                                        <?php
                                                print"<p id = 'img'><strong>Joueur : </strong>";
                                                print $tab[$i]['ID']; 
                                                print"<br/> <strong>Temps : </strong>";
                                                print $tab[$i]['time'];
                                                print"   <strong>Score : </strong>";
                                                print $tab[$i]['points'];
                                                
                                                print"</p>";
                                                
                                                $progression=$tab[$i]['progression']/nombreGames()*100;
                                                ?>
                                        </div>

                                    </div>
                                    <div class = "row justify-content-center">
                                        <div class = "col-12">
                                            <div class="progress" style="height:10px">
                                                <div class='progress-bar <?php if($progression<=25){print"bg-danger";}else{if($progression>25 && $progression<= 50){print"bg-warning";}else{if($progression>50 && $progression<=75){print"bg-info";}else{print"bg-sucess";}}}?>' role="progressbar" style="height:10px ; width: <?php print($progression) ?>% " aria-valuenow= "<?php print($progression) ?>"  aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                </div>
                            </div> 
                        <?php
                        }
                        ?>  
                    </div>
                </div>
            </div>
            <div class = "col-3" id = "part_act">
                <h1 class = "titre_home">CHAT</h1>
                <div class = 'row justify-content-center'>
                    <div id ="part_act2" class= "col-10" >
                    <?php 
                        if(!empty($_GET['chatuser']))
                        {
                        $_SESSION['chatuser']=$_GET['chatuser'];
                        
                        $tab = infosMessages($_SESSION['chatuser']);
                        for($i=nombreMessages($_SESSION['chatuser'])-1;$i>=0;$i--)
                        {
                            ?>
                            <div class = "row justify-content-center">
                                <div id = "message_user" class ="col-10">
                                    <?php
                                        $message = $tab[$i]['message'];
                                        print "<p id = 'msg'>";
                                        print $message;
                                        print "</p>";
                                    ?>
                                </div>
                            </div>
                        <?php
                        }
                        }
                
                        ?>
                    
                                  
                    </div>
                </div>
                <div class = "row justify-content" id="envoyer_aide">
                    <div class="col-3">
                        <form method = "POST" action = "test.php">
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="1"></textarea>
                                <button type="submit" class="btn btn-dark">Envoyer de l'aide</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            
            <div class = "col-4" id = "part_act">
                <h1 class = "titre_home">Creer une enigme</h1>
                <?php
                if(empty($_POST['title']))
                {
                ?>
                <form method = "POST" action = "test.php">
                    <div id = "create_enigme" class="form-group">
                        
                        <label for="titre">Titre de l'énigme</label>
                        <input type="text" name="title" class="form-control" id="titre">
                        <label for="corps">Corps de l'énigme</label>
                        <textarea name="body" class="form-control" id="corps" rows="2"></textarea>
                        
                    
                        
                        <br/>
                        <label for="upload1">Uploader une image, un son ou une vidéo</label>
                        <input name = "filetoUpload"type="file" class="form-control-file" id="upload1">
                        <br/>
                        <label for="upload2">Uploader une image de fond (1920x1080)</label>
                        <input name = "filetoUpload2"type="file" class="form-control-file" id="upload2">
                        <br/>
                        <select name = "type" class="form-control">
                        <option>Reponse texte</option>
                        <option>Reponse unique</option>
                        
                        </select>
                        <br/>
                        <button type="submit" class="btn btn-dark">Suivant</button>
                                        
                    </div>
                </form>
                <?php
                }
                else
                {
                    if(!empty($_POST['type']))
                    {
                    if($_POST['type'] == "Reponse texte")
                    
                 
                { ?>

                        <form method = "POST" action = "test.php">
                            <div id = "create_enigme" class="form-group">
                                <label for="titre">Réponse à l'énigme</label>
                                <input type="text" name="title" class="form-control" id="titre">
                                <br/>
                                <button type="submit" class="btn btn-dark">Creer l'énigme</button>
                            </div>
                        </form>
                    <?php
                    }
                    else 
                    if($_POST['type'] == "Reponse unique")
                    { ?>
                        <form method = "POST" action = "test.php">
                        <div id = "create_enigme" class="form-group">
                            <?php
                            for($a = 1; $a<5; $a++)
                            {
                            print"<label for='titre'>Proposition $a</label><input type='text' name='prop$a' class='form-control' id='titre'>";
                        } ?>
                        <br/>
                        <label for="titre">Réponse à l'énigme</label>
                        <input type="text" name="title" class="form-control" id="titre">
                        </div>
                        <button type="submit" class="btn btn-dark">Creer l'énigme</button>
                        </form>
                    <?php
                    
                    }
                }
                    else
                    {
                        print "<div class='alert alert-success' role='alert'>
                        Bien joué ! Tu as créé l'énigme.
                      </div>";
                        ?>
                        <form method = "POST" action = "test.php">
                        <button type="submit" class="btn btn-dark">Super</button>
                        </form>
                        <?php
                    }
                    
                
                
            }
        }?>

            </div>
        </div> 
    </div>






    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>