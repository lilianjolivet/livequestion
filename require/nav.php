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
                        <a class="nav-link" href="./profil-utilisateur.php">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?php 
                        if(isset($_SESSION['utilisateur']) && !empty($_SESSION['utilisateur'])){
                            echo $_SESSION['utilisateur']['pseudo'].', role: ('.$_SESSION['utilisateur']['role'].'), num id: ('.$_SESSION['utilisateur']['id'].')'; 
                        }?>
                        </a>
                    </li>
                    <?php if($_SESSION['utilisateur']['role'] == 2){?>
                    <li class="nav-item">
                        <a class="nav-link" href="./administration.php">
                            administration
                        </a>
                    </li>
                    <?php }?>
                    <li class="nav-item">
                        <a class="nav-link" href="./require/logout.php">déconnexion</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>