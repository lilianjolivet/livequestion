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
                        <a class="nav-link" href="#">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?php 
                        if(isset($_SESSION['utilisateur']) && !empty($_SESSION['utilisateur'])){
                            echo $_SESSION['utilisateur']['pseudo'].', '.$_SESSION['utilisateur']['id']; 
                        }?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./require/logout.php">Log Out Btn</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>