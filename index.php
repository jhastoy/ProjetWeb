<!DOCTYPE html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="style_Accueil.css">
<?php require_once "includes/head.php"; ?>
<body>
    <div class = "container">
        <div class = "row justify-content-center">
            <div class="jumbotron" id="opaq_blanc">
                <div class="row">
                    <div class="col-md-7 col-md-11">
                        <img id = "logo" src = "images/logo.png"/>
                    <br/>
                    <br/>
                        <p>Aidez le misérable FatPat'Bat dans son apprentissage laborieux de la batterie au travers d'un escape game virtuel retraçant l'histoire de la musique !</p>
                    </div>
                </div>   
            </div> 
        </div>    
        <div class = "row justify-content-center"> 
            <form action = "login.php" accept-charset="UTF-8"> 
            <button type="submit" class="btn btn-dark btn-lg" id="bouton_accueil">Aider le FatPat'Bat</button>     
            </form>
        </div>
        
    </div>
    <video id = "mavideo" autoplay loop>

            <source src="images/sans_titre.mp4"
                    type="video/mp4">
                    </video>
             
    
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>