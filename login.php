<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="main.js"></script>
    <link rel="stylesheet" href="CSS_login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

  <div id = "log"  class = "container" >

    <?php require("connect.php");
      if(empty($_POST['id']) == false && empty($_POST['email']) == false)
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $id = $_POST['id'];
            $Requete = "SELECT count(*) as nb from USERS where ID = '$id' OR email = '$email'";
            $res = $BDD -> query($Requete);
            $ligne = $res->fetch();
            $nb = $ligne['nb'];
            if($nb!=0)
            {
              print '<div class = "row justify-content-center">
              <div class = "col-8"> <div class="alert alert-danger" role="alert">
              <strong>Identifiant</strong> ou <strong>email</strong> déjà utilisé !
            </div></div></div>';
            }
            else
            {
              $Requete = "INSERT INTO users (id, password,email, admin) VALUES ('$id', '$password','$email', false)";
              $BDD -> query($Requete);
              print '<div class = "row justify-content-center">
              <div class = "col-8"> <div class="alert alert-success" role="alert">
              Vous êtes à présent inscris ! Vous pouvez vous <strong>connecter</strong>.
            </div></div></div>';
            }
          
        }
        if(empty($_POST['id_connect']) == false && empty($_POST['password_connect']) == false)
        {
        
          $password = $_POST['password_connect'];
          $id = $_POST['id_connect'];
          $Requete = "SELECT count(*) as nb from USERS where ID = '$id' AND PASSWORD = '$password'";
          $res = $BDD -> query($Requete);
          $ligne = $res->fetch();
          $nb = $ligne['nb'];
          if($nb == 0)
          {
            print '<div class = "row justify-content-center">
            <div class = "col-8"> <div class="alert alert-danger" role="alert">
            <strong>Identifiant</strong> ou <strong>mot de passe</strong> incorrect !
          </div></div></div>';
          }
          else
          {
            header('Location: test.php');
            exit();
          }
        }
        
        
        
    ?>
    <div  id = "blank" sclass = "row justify-content-center"><div>
    <div class = "row justify-content-center">
    <div class = "col-4">
    <h1> Connexion </h1>
    </div>
    <div class = "col-4">
    <h1> Première partie ? </h1>
    </div>
    </div>
    <div class = "row justify-content-center">
    </p>
    
    <div class = "col-4">
    <div class = "card card-body bg-dark text-white">
    <form method = "POST" action = "login.php">
  <div class="form-group">
    <label for="exampleInputEmail1">Identifiant</label>
    <input name = "id_connect" type="id" class="form-control" id="exampleInputEmail1"  placeholder="Entrer identififiant" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Mot de passe</label>
    <input name="password_connect" type="password" class="form-control" id="exampleInputPassword1" placeholder="Entrer mot de passe" required>
  </div>
  <button type="submit" class="btn btn-dark">Se connecter</button>
</form>
</div>
</div>


<div class = "col-4">
    <div class = "card card-body bg-dark text-white">
    <form method = "POST" action = "login.php">
  <div class="form-group">
    <label for="exampleInputEmail1">Identifiant</label>
    <input name = "id" type="id" class="form-control" id="exampleInputEmail1"  placeholder="Entrer identififiant" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Mot de passe</label>
    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Entrer mot de passe" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail">Adresse Email</label>
    <input name="email" type="email" class="form-control" id="exampleInputPassword1" placeholder="Entrer email" required>
  </div>
  <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>
</div>
</div>
</div>
      </div>
      </div>









    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>