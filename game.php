<!DOCTYPE html>
<?php require_once "includes/head.php"; ?>
<body background = "images/fond_home.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css_login.css">
    <?php
    session_start();
    require_once "includes/header.php";
    require_once "includes/connect.php"; 
    require_once "includes/fonctions.php";
    
    $progression = queryBDD('progression','scores','ID',$_SESSION['id']);

    if(!empty($_POST['reponse']))
    {
        $reponse = queryBDD('reponse','games','ID_game',$progression);
        if($reponse == $_POST['reponse'])
        {
            $_SESSION['reponse']='vrai';
            header("Location: result.php");
        }
        else
        {
            $_SESSION['reponse']='faux';
            header("Location: result.php");
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
                $_SESSION['reponse']='vrai';
                header("Location: result.php");
            }
            else
            {
                $_SESSION['reponse']='faux';
                header("Location: result.php");
            }
        }
    ?>


    <div class = "container">
        <div class ="row justify-content-center">
            <div id="titre_enigme" class = "col-7">
                <h1 id="nom_enigme"> <?php print(queryBDD('title','games','ID_game',$progression)); ?> </h1>
            </div>
        </div>
        <div class = "row justify-content-center">
            <div id ="corps_enigme" class = "col-12">
                <p><?php print(queryBDD('body','games','ID_game',$progression)); ?></p>
                <br/>
                <?php print(queryBDD('content','games','ID_game',$progression)); ?>
            </div>
        </div>
        <div class = "row justify-content-center">
            <form method = "POST" action = "game.php">
                <?php 
                    if(queryBDD('type','games','ID_game',$progression) == 0)
                    {
                        ?>
                        
                            <label for="reponse">Ta réponse</label>
                            <input name = "reponse" type="text" class="form-control" id = "reponse">
                    
                        <?php
                    }
                    else
                    {
                        if(queryBDD('type','games','ID_game',$progression) == 1)
                        {
                            ?>
                                <label for="reponse">Ta réponse</label>
                                <select name="reponse" multiple class="form-control" id="reponse">
                                    <?php
                                        for($i = 1; $i<=4; $i++)
                                        {
                                            print"<option>";
                                            print(queryBDD("select$i",'game_select',"ID_game",$progression));
                                            print"</option>";
                                        }
                                        ?>
                                </select>
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
                <button type="submit" class="btn btn-dark">Valider</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>