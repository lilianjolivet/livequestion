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
        <link rel="stylesheet" href="style1.css">
    </head>
    <body>
        <?php

        require_once('./req_sql.php');
        $profils = recupererProfil();

        require_once('./traitement.php');
            if(!empty($_POST)){
                $traitement = traitementFormulaire($_POST);
            }
        ?>
        <form action="#" method="POST">

            <div class="segment">
                <h1>Inscrivez-vous</h1>
            </div>

            <label>
                <input name="identifiant" type="text" placeholder="Identifiant"/>
            </label>
            <span class="erreur">
                <?php
                if (isset($traitement) && !$traitement['succes'] 
                    && isset($traitement['erreurs']['identifiant'])) {
                    echo $traitement['erreurs']['identifiant'];
                }
                ?>
            </span>
            <label>
                <input name="email" type="text" placeholder="Adresse Mail"/>
            </label>
            <span class="erreur">
                <?php
                if (isset($traitement) && !$traitement['succes'] 
                    && isset($traitement['erreurs']['email'])) {
                    echo $traitement['erreurs']['email'];
                }
                ?>
            </span>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Sexe</label>
                </div>
                <select name="sexe" class="custom-select" id="inputGroupSelect01">
                    <option value="femelle">Femme</option>
                    <option value="male">Homme</option>
                </select>
            </div>
            <span class="erreur">
                <?php
                if (isset($traitement) && !$traitement['succes'] 
                    && isset($traitement['erreurs']['sexe'])) {
                    echo $traitement['erreurs']['sexe'];
                }
                ?>
			</span>
            <label>
                <input name="password" type="password" placeholder="Mot de passe"/>
            </label>
            <span class="erreur">
                <?php
                if (isset($traitement) && !$traitement['succes'] 
                    && isset($traitement['erreurs']['password'])) {
                    echo $traitement['erreurs']['password'];
                }
                ?>
			</span>
            <label>
                <input type="password" placeholder="Vérification du Mot de passe" name="password-verif"/>
            </label>
            <span class="erreur col-md-12">
                <?php
                if (isset($traitement) && !$traitement['succes'] 
                    && isset($traitement['erreurs']['password-verif'])) {
                    echo $traitement['erreurs']['password-verif'];
                }
                if(isset($_POST['password']) && !empty($_POST['password'])){
                    if(($_POST['password'])!=($_POST['password-verif'])){
                        echo '<span class="erreur">Veuillez saisir le même mot de passe</span>';
                    }
                }
                ?>
			</span>
             <button id="connexion" class="red" type="submit"> <a href="connexion.php">Se Connecter</a></button>
        </form>
        
        <?php
        if(isset($_POST) && !empty($_POST)){
            $answer = 1;
            foreach($profils as $profil){
                if(($profil['Pseudo_profil'])==($_POST['identifiant'])){
                    echo '<span class="erreur">Identifiant déjà utiliser</span>';
                    $answer = 0;
                }
            }
            if(($_POST['password'])!=($_POST['password-verif'])){
                $answer = 0;
            }
            if(($answer == 1)){
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
                ajoutProfil($_POST);
            }
            
        }
        ?>
    </body>
</html>