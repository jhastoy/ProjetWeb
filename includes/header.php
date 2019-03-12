<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="index.php"><img id = "logo" src = "images/logo.png"/></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  

  <div  class="collapse navbar-collapse" id="navbarNav">

    <ul class="navbar-nav ml-auto">
        <?php

        if(isset($_SESSION['id']) == false)
        {
            print'

      <li class="nav-item active">
      
        <button class="btn btn-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-user"></span>Non connecté</button>

      </li>
        ';
        }
        else
        {
            $id = $_SESSION['id'];
           ?> 

      <li class="nav-item active">
      
      <div class="dropdown">
      <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php print "Bienvenue $id" ?>
      </a>
    
      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="#">Profil</a>
        <a class="dropdown-item" href="#">Mes équipes</a>
        <div class="dropdown-divider"></div>
 
        <a class="dropdown-item" href="#"><strong>Se déconnecter</strong></a>
      </div>
    </div>

      </li>
      <?php
        }
        ?>

    </ul>
  </div>
</nav>