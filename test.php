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
                    <p id ="description"> Fatpatbat est un jeune apprenti de la batterie. Sa véritable identité est Daniel Auteuil mais ça n'a pas de lien. Son soucis est qu'il est vraiment ridicule musicalement parlant et même sa batterie le déteste ! Fatpatbat va donc aller explorer le monde de la musique afin d'essayer de la comprendre et de jouer autre chose que "smell like teen spirit" et "highway to hell" ou au moins de le jouer mieux!!! Pour cela il a besoin de toi!!! Aide fatpatbat à traverser l'histoire de différents styles musicaux et à affronter les différentes énigmes qui seront sur son chemin !!</p>
                    </div>
                </div>
                <div class = "row justify-content-center">
                    
                    <div class = "col-4">
                    <a href = 'regles.php'><button class="btn btn-dark" style="text-align:center" type="submit">Règles</button></a>
                    </div>
                    <div class = "col-6">
                    <?php 
                    if(queryBDD('progression', 'scores', "ID", $_SESSION['id']) == 0)
                    {
                    ?>
                    <a href = "create_team.php"><button id = 'play' class='btn btn-dark' style='text-align:center' type='submit'>Lancer partie</button></a>
                    
                    <?php
                    }
                    ?>
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
                                    <?php 
                                           $progression= queryBDD('progression','scores','ID',$_SESSION['id']);
                                           if (empty(queryBDD('image','games','ID_game',$progression)))

                                          {
                                               print " <img id = 'img' src = 'images/enigme1.jpg' width= '250px' />";
                                          }
                                          else
                                          {
                                            $nom_image = queryBDD('image','games','ID_game',$progression);
                                            print "<img id = 'img' src = 'upload/$nom_image'  width= '250px' />" ; 
                                          }
                                           ?>
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
                                    <div class = "col-11">
                                        <div class="progress" style="height:10px">
                                            <div class='progress-bar <?php if($progression<=25){print"bg-danger";}else{if($progression>25 && $progression<= 50){print"bg-warning";}else{if($progression>50 && $progression<=75){print"bg-info";}else{print"bg-sucess";}}}?>' role="progressbar" style="height:10px ; width: <?php print($progression) ?>% " aria-valuenow= "<?php print($progression) ?>"  aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>           
                            <div class = "row justify-content-center">
                                <div class = "col-12 text-center" id="reprise">
                                <?php
                                    if(queryBDD('progression', 'scores', "ID", $_SESSION['id']) == nombreGames())
                                    {
                                        print "<p> Tu as terminé le jeu! Reviens plus tard pour de nouvelles épreuves! </p>";
                                    }
                                    else
                                    {
                                        print" <a href = 'game.php'><button type='submit' class='btn btn-dark'>Reprende la partie</button></a>";
                                    }  
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
        <?php
            }
            ?>
        <div class="col-2" id="scores">
        <h1 class = "titre_home">Top fatbat'ers</h1>
        <?php
                $players = arrayPlayers();
                $nb_players = nb_joueurs_fpb();
                
                print "<p>";
                print "<table>";
                for ($i = 0;$i<10 && $i <$nb_players ; $i++)
                {
                    print "<tr>";
                    print "<td>".($i+1)."      "."</td>";
                    print "<td>".$players[$i]['ID']."      "."</td>";
                    print "<td>".$players[$i]['points']."      "."</td>";
                    
                    print "</tr>";
                }
                
                print "</table>";
                print "</p>";
        ?>
        </div>
    </div>
</div>
<?php 


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
                                            
                                          <?php 
                                           $progression= $tab[$i]['progression'];
                                           if (empty(queryBDD('image','games','ID_game',$progression)))

                                          {
                                               print " <img id = 'img' src = 'images/enigme1.jpg' width= '100px' />";
                                          }
                                          else
                                          {
                                            $nom_image = queryBDD('image','games','ID_game',$progression);
                                            print "<img id = 'img' src = 'upload/$nom_image'  width= '100px' />" ; 
                                          }
                                           ?>
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
                                                ?>
                                        </div>
                                      <?php  $progression= $tab[$i]['progression']/nombreGames()*100; ?>
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
                    <div class="col-12">
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
                if(empty($_POST['title']) && empty($_POST['reponse']))
                {
                ?>
                <form enctype="multipart/form-data" method = "POST" action = "test.php">
                    <div id = "create_enigme" class="form-group">
                        
                        <label for="titre">Titre de l'énigme</label>
                        <input type="text" name="title" class="form-control" id="titre">
                        <label for="corps">Corps de l'énigme</label>
                        <textarea name="body" class="form-control" id="corps" rows="2"></textarea>
                        
                    
                        
                        <br/>
                        <label for="upload1">Uploader une image, un son ou une vidéo</label>
                        <input type = "hidden" name = "MAX_FILE_SIZE" value = "10000000000000" />
                        <input name = "content" type="file"  class="form-control-file" id="upload1"/>
                        <br/>
                        <label for="upload2">Uploader une image de fond (1920x1080)</label>
                        <input type = "hidden" name = "MAX_FILE_SIZE" value = "10000000000000" />
                        <input name = "fond" type="file"  class="form-control-file" id="upload1"/>
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

                    if(!empty($_POST['type']) && empty($_POST['reponse']))
                    {
                        
                        $var = uploadImage($_FILES,'upload','content','fond');
                        if($_POST['type'] == "Reponse texte")
                        { 
                        insertEnigme1($_POST['title'], $_POST['body'], 0);
                        ?>

                            <form method = "POST" action = "test.php">
                                <div id = "create_enigme" class="form-group">
                                    <label for="titre">Réponse à l'énigme</label>
                                    <input type="text" name="reponse" class="form-control" id="titre">
                                    <label for="number">Nombre de points associés à l'énigme (1 pt = 1 sec)</label>
                                    <input type="text" name="point" class="form-control" id="point">
                                    <br/>
                                    <button type="submit" class="btn btn-dark">Creer l'énigme</button>
                                </div>
                            </form>
                        <?php
                        }
                        else 
                        {
                            if($_POST['type'] == "Reponse unique")
                            { 
                                insertEnigme1($_POST['title'], $_POST['body'], 1)
                                ?>
                                <form method = "POST" action = "test.php">
                                <div id = "create_enigme" class="form-group">
                                    <?php
                                    for($a = 1; $a<5; $a++)
                                    {
                                    print"<label for='titre'>Proposition $a</label><input type='text' name='prop$a' class='form-control' id='titre'>";
                                    } ?>
                                    <label for="titre">Réponse à l'énigme</label>
                                    <input type="text" name="reponse" class="form-control" id="titre">
                                    <label for="number">Nombre de points associés à l'énigme (1 pt = 1 sec)</label>
                                    <input type="text" name="point" class="form-control" id="point">
                                    <br/>
                                    <button type="submit" class="btn btn-dark">Creer l'énigme</button>
                                </div>
                                </form>
                               <?php
                                
                            }
                        }
                        $nbreGames = nombreGames() ;
                        $BDD -> query("update games set image = '$var[2]' where ID_game = $nbreGames");
                        $BDD -> query("update games set content = '$var[0]' where ID_game = $nbreGames");
                        if($var[1] == ".png")
                        {
                            $BDD -> query("update games set TypeContent = 0 where ID_game = $nbreGames");
                        }
                        else
                        {
                            if($var[1] == ".mp3")
                            {
                                $BDD -> query("update games set TypeContent = 1 where ID_game = $nbreGames");
                            }
                            else
                            {
                                if($var[1] == ".mp4")
                                {
                                $BDD -> query("update games set TypeContent = 2 where ID_game = $nbreGames");
                                }
                            }
                        }   
                    ?>
                          
                        <?php
                    
                    }
                
                    else
                    {
                        if(!empty($_POST['prop1']))
                        {
                            $ID_select = nombreGames();
                            $requete = "insert into game_select (ID_game) values ($ID_select) ";
                            $BDD -> query($requete);
                            for($i = 1; $i<5; $i++)
                            {
                                
                                $prop = $_POST["prop$i"];
                                $requete = "update game_select set select$i = '$prop' where ID_game = $ID_select";
                                $BDD -> query($requete);
                            }
                            $reponse = $_POST['reponse'];
                            $BDD -> query("update games set reponse = '$reponse' where ID_game = $ID_select");
                            
                        }
                        $ID_select = nombreGames();
                        $reponse = $_POST['reponse'];
                        $point = $_POST['point'];
                        $requete = " update games set reponse = '$reponse' where ID_game = $ID_select";
                        $BDD -> query($requete);
                        $requete = "update games set points_enigme = '$point' where ID_game = $ID_select";
                        $BDD -> query($requete);
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
                
            }
        ?>

            </div>
        </div> 
    </div>






    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>