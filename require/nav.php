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
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#menu-profil" href="#">
                        <?php 
                        if(isset($_SESSION['utilisateur']) && !empty($_SESSION['utilisateur'])){
                            echo $_SESSION['utilisateur']['pseudo']; 
                        }?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <?php
    require_once('./db/req_sql.php');

    $profils = recupProfil();
    foreach($profils as $profil){
        if($_SESSION['utilisateur']['id'] == $profil['Id_profil']){
            $avatar = $profil['avatar'];
        }
    }
    ?>
    <!-- Modal menu-profil-->
    <div class="modal fade" id="menu-profil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="./images/avatars/<?php echo $avatar?>" class="rounded avatar-option" alt="<?php echo $avatar?>">
                    <h4>
                    <?php 
                        if(isset($_SESSION['utilisateur']) && !empty($_SESSION['utilisateur'])){
                            echo $_SESSION['utilisateur']['pseudo']; 
                        }
                    ?>
                    </h4>
                </div>
                <div class="modal-body">
                    <li>
                        <a class="nav-link" href="./page-perso-profil.php">Profil</a>
                    </li>
                    <?php if($_SESSION['utilisateur']['role'] == 2){?>
                    <li>
                        <a class="nav-link" href="./administration.php">
                            administration
                        </a>
                    </li>
                    <?php }?>
                    <li class="nav-item">
                        <a class="nav-link" href="./require/logout.php">déconnexion</a>
                    </li>
                </div>
            </div>
        </div>
    </div>