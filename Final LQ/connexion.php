<?php session_start();?>

<html>
    <head>
        <title>Laura Goncalves</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="images/IMG-0036.png">
        <link rel="stylesheet" href="style-formulaire-reg-log.css">
    </head>
    <body>
        <?php

        require_once('./db/req_sql.php');
        $profils = recupProfil();

        require_once('./traitement/traitement_formulaire.php');
            if(!empty($_POST)){
                $traitement = traitementFormulaireConnexion($_POST);
            }
        ?>
        <form class ="formulaire" action="#" method="POST">

            <div class="segment">
                <h1>Connectez-vous</h1>
            </div>

            <label>
                <input type="text" placeholder="identifiant" name="identifiant"/>
            </label>
            <span class="erreur">
                <?php
                if (isset($traitement) && !$traitement['succes'] 
                    && isset($traitement['erreurs']['identifiant'])){
                    echo $traitement['erreurs']['identifiant'];
                }
                ?>
            </span>
            <label>
                <input type="password" placeholder="Mot de passe" name="password"/>
            </label>
            <span class="erreur">
                <?php
                if (isset($traitement) && !$traitement['succes'] 
                    && isset($traitement['erreurs']['password'])){
                    echo $traitement['erreurs']['password'];
                }
                ?>
            </span>
            <button id="inscrire" class="red" type="submit">Se connecter</button>
            <a href="inscription.php"><button id="connexion" class="red" type="button">S'inscrire</button></a>
        </form>
        <?php 
        if(isset($_POST) && !empty($_POST)){
            foreach($profils as $profil){
                if(($profil['Pseudo_profil'] == $_POST['identifiant']) && (password_verify($_POST['password'],$profil['MotDePasse_profil']))){
                    $_SESSION['utilisateur']=[
                        'pseudo' => $profil['Pseudo_profil'],
                        'id' => $profil['Id_profil'],
                    ];
                    header("Location: ./home.php");
                }
            }
        }   
        ?>
    </body>
</html>