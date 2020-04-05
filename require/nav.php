<?php
    require_once('./db/req_sql.php');

    $profils = recupProfil();
    foreach($profils as $profil){
        if($_SESSION['utilisateur']['id'] == $profil['Id_profil']){
            $avatar = $profil['avatar'];
        }
    }
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">LiveQuestion</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./home.php">Flux de questions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./ajout-question.php">Ajouter</a>
                </li>
            </ul>
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <h5>
                        <?php 
                        if(isset($_SESSION['utilisateur']) && !empty($_SESSION['utilisateur'])){
                            echo $_SESSION['utilisateur']['pseudo']; 
                        }?>
                        </h5>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="./page-perso-profil.php">Profil</a>
                        <?php if($_SESSION['utilisateur']['role'] == 2){?>
                                <a class="dropdown-item" href="./administration.php">Administration</a>
                        <?php }?>
                        <a class="dropdown-item" href="./require/logout.php">Déconnexion</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#modal-unsubscribe" href="">Déinscription</a>
                    </div>
                </li>
                <li class="nav-item">
                    <img src="./images/avatars/<?php echo $avatar?>" class="rounded avatar-option" alt="<?php echo $avatar?>">
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Modal validation déinscription -->
<div class="modal fade" id="modal-unsubscribe" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-unsubscribe" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h5>Voulez-vous vraiment supprimer votre compte ?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" onclick="window.location.href='./db/req_supp_sql.php?id_supp=<?php echo $_SESSION['utilisateur']['id']?>';">valider</button>
        <button type="button" class="btn" data-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>