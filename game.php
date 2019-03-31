<!DOCTYPE html>
<?php require_once "includes/head.php"; 
    session_start();
    require_once "includes/fonctions.php";
$progression = queryBDD('progression','scores','ID',$_SESSION['id']);
$fond = queryBDD('image','games','ID_game',$progression);

if (empty($fond))
{
    print "<body style='background: url(images/enigme1.jpg) no-repeat; width: 99%; background-size: 100%;'>";
}
else
{
    print "<body style='background: url(upload/$fond) no-repeat; width: 99%; background-size: 100%;'>";
}?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css_login.css">
    <?php
    
    require_once "includes/header.php";
    require_once "includes/connect.php"; 
    $rep = 'rien';
    if(!empty($_POST['message']))
    {
        sendChat($_SESSION['id'], $_POST['message']);
        updateBDD('users','HELP',true,'ID',$_SESSION['id']);
        header('Location: game.php');
        exit();
    }



    if(!empty($_POST['reponse']))
    {
        $reponse = queryBDD('reponse','games','ID_game',$progression);
        if($reponse == $_POST['reponse'])
        {
            $rep='vrai';
         
        }
        else    
        {
            $rep ='faux';
            
        }
    }
    else
        if(!empty($_POST['1']) || !empty($_POST['2'])|| !empty($_POST['3']) || !empty($_POST['4']) || !empty($_POST['5']))
        {
            foreach($_POST as $value)
            {
                $reponseU = $reponseU . " " .$value;
            }
            $reponse = queryBDD('reponse','games','ID_game',$progression);
            if($reponse == $reponseU)
            {
                $rep='vrai';
            }
            else
            {
                $rep='faux';
            }
        }
    ?>
        <div class ="row justify-content-around">
            <div id="titre_aide" class = "col-3">
                <h1 id="nom_enigme">AIDE</h1>
            </div>
            <div id="titre_enigme" class = "col-8">
                <h1 id="nom_enigme"> <?php print(queryBDD('title','games','ID_game',$progression)); ?> </h1>
            </div>
        </div>
        
        
        <div class = "row justify-content-around">
            <div id ="corps_aide" class = "col-3">
                <div class = "row justify-content-center">
                    <div id="chat_user" class="col-10">
                        <?php 
                        $tab = infosMessages($_SESSION['id']);
                   
                        for($i=nombreMessages($_SESSION['id'])-1;$i>=0;$i--)
                        {
                            ?>
                            <div class = "row justify-content-center">
                                <div id = "message_user" class ="col-10">
                                    <?php
                                      $message = $tab[$i]['message'];
                                        print "<p id = 'msg'>";
                                        print $message;
                                        print "</p>";?>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class = "row justify-content-center">
                    <div class="col-10">
                        <form method = "POST" action = "game.php">
                            <div class="form-group" method = "POST" action = "game.php">
                                <textarea class="form-control" name="message" rows="1"></textarea>
                                <br/>
                                <p>
                                <button type="submit" class="btn btn-dark">Demander de l'aide</button>
                                 </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id ="corps_enigme" class = "col-8">
            <?php 
            if($rep=='vrai' || $rep =='faux')
            {
                require "includes/connect.php" ;
                $requete = "SELECT SUM(points_enigme) AS somme FROM games";
                $res = $BDD -> query($requete);
                $ligne = $res -> fetch();
                $value = $ligne["somme"];
                if (queryBDD('points', 'scores', 'ID', $_SESSION['id']) > $value)
                {
                    print $value;
                    $_SESSION['victoire'] = false;
                    print("tu as perdu");
                    ?>
                    <form action = "end.php">
                        <button type="submit" class="btn btn-dark">Terminer</button>
                    </form>
                    <?php
                 
                }
                else
                {
                    $time2 = new DateTime();
                    $time3 = $_SESSION['début'] -> diff($time2); 
                    ajoutpoints ($time3,$_SESSION['id']);

                    if ($rep== 'faux')
                    {
                        updateBDD('scores','points',queryBDD('points', 'scores', 'ID',$_SESSION['id'] ) + queryBDD('points_enigme','games', 'ID_game',$progression)/2,'ID',$_SESSION['id']);
                        $tab_fail = [
                            1 => " <p>Même le minable FatPatBat avait la réponse à cette question! Il n'avait juste pas assez confiance en lui pour la donner. <br/> \" C'est vrai \"  Fatpatbat </p> " ,
                            2 => "<p> C'est faux sale loser ! <br/> C'est le marathon de la nullité ? Toi et ton équipe essayez d'être le plus naze possible?! </p>" ,
                            3 => "<p> Faux mon p'tit pote! <br/> Ton partenaire va finir avec moi si tu continues " ,
                            4 => "<p> Mauvaise réponse! <br/> Je suis avec Jacques Brel et il te deteste officiellement mon gars. Bye bye les vacances avec lui dans les pyrénnées."
                            ];
                            $alea =  random_int(1,4); 
                            print $tab_fail[$alea];
                            print "<br/>  <p  class = 'infos'>Ton score : ".queryBDD('points', 'scores', 'ID', $_SESSION['id'])."</p>"; 
                    }

                    else
                    {
                        if(queryBDD('progression', 'scores', 'ID', $_SESSION['id'] ) == nombreGames())
                        {
                            print "Bravo tu as fini le jeu";
                            $_SESSION['victoire'] = true;
                            ?>
                            <form action = "end.php">
                                <button type="submit" class="btn btn-dark">Terminer</button>
                            </form>
                            <?php
                        }
                        else
                        {
                            $tab_reussi = [
                            1 => " <p> oh mon dieu c'est juste! Fatpatbat te remercie et promet de se faire tatouer ton visage sur le sien pour te ressembler d'avantage!</p> " ,
                            2 => "<p> mec arrête d'être si fort! Les francs-maçons te jalousent et ils l'assument car ce sont des ouvriers sincères. </p>" ,
                            3 => "<p> MAIS TU ES INCOLLABLE. Comme un rat de bibliothèque." ,
                            4 => "<p> \" Ahaha cet homme est incroyable\" a dit Mozart en te voyant débiter la bonne réponse telle ta carte bleue lorsque tu bois trop. Ivrogne" 
                            ];
                            $alea =  random_int(1,4); 
                            print $tab_reussi[$alea];
                            print "<br/>  <p  class = 'infos'>Ton score : ".queryBDD('points', 'scores', 'ID', $_SESSION['id'])."</p>"; 
                            updateBDD('scores','progression',queryBDD('progression', 'scores','ID', $_SESSION['id']) + 1 ,'ID',$_SESSION['id']);
                        }
                    }
                    ?>
                    <form action = "game.php">
                        <div class="row justify-content-center">
                    <button type="submit" class="btn btn-dark">Continuer</button>
                        </div>
                    </form>

                <?php
                // on créé une deuxième variable time lorsque la réponse est envoyée, on fait ensuite la différence avec le premier time et on obtient le temps mis pour faire l'enigme
                 }
                
                 
            }
            else
            {
                $time = new DateTime() ;
                $_SESSION['début'] = $time ; /// timeeeeeeeeeeeeeeeeeeeeeee 
            ?>
                <p><?php
                
                 print(queryBDD('body','games','ID_game',$progression)); ?></p>
                <br/>
                <?php
                if(queryBDD('TypeContent','games','ID_game',$progression)==0)
                {
                    $img = queryBDD('content','games','ID_game',$progression);
                    print"<img src = 'upload/$img'/>";
                }
                else
                {
                    if(queryBDD('TypeContent','games','ID_game',$progression)==2)
                    {
                        $video = queryBDD('content','games','ID_game',$progression);
                        print "<p><video width='400' height='250' controls>
                        <source src='upload/$video' type='video/mp4'></p>";
                    }
                    else
                    {
                        $son = queryBDD('content','games','ID_game',$progression);
                        print "<audio loop autoplay src='upload/$son'></audio>";
                    }
                }
                ?>
          </div>
        </div>  
        <div class = "row justify-content-around">
            <div class = "col-6">
            </div>
            <div class = "col-4">
            <form method = "POST" action = "game.php">
                <?php 
                
                    if(queryBDD('type','games','ID_game',$progression) == 0)
                    {
                        ?>
                            <input name = "reponse" type="text" class="form-control" >
                            <p>
                            <button type="submit" class="btn btn-dark">Valider</button>
                            </p>
                
                        <?php
                    }
                    else
                    {
                        if(queryBDD('type','games','ID_game',$progression) == 1)
                        {
                            ?>
                                
                                <select name="reponse" multiple class="form-control" >
                                    <?php
                                        for($i = 1; $i<=4; $i++)
                                        {
                                            print"<option>";
                                            print(queryBDD("select$i",'game_select',"ID_game",$progression));
                                            print"</option>";
                                        }
                                        ?>
                                </select>
                                <p>
                                <button type="submit" class="btn btn-dark">Valider</button>
                                </p>
                                <?php
                        }
                        else
                            {
                                for($i=1;$i<=5; $i++)
                                {
                                    ?>
                                <div class="form-check form-check-inline">
                                    <input name="$i" class="form-check-input" type="checkbox" id="check<?php print($i);?>" value="<?php print(queryBDD("radio$i",'game_radio',"ID_game",$progression));?>">
                                    <label class="form-check-label" for="check<?php print($i);?>"><?php print(queryBDD("radio$i",'game_radio',"ID_game",$progression));?></label>
                                </div>
                                <?php
                                }
                            }
                    }
            
                ?>
                <br/>
                
               
               
                
            </form>
                </div>
                <div class = 'col-2'>
                </div>    
            <?php
            }
            ?>
       
        </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>