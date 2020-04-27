<?php 
    require_once('./require/header.php');
?>

<body class="bodyForm">
    <?php
    require_once('./db/req_sql.php');
    $profils = recupProfils();

    require_once('./traitement/traitement_formulaire.php');
    if(!empty($_POST)){
        $traitement = traitementFormulaireInscription($_POST);
    }
    ?>
    <!-- Début du formulaire d'inscription avec toute les vérification -->
    <form class="formContactIncri" action="#" method="POST">

        <div class="segment">
            <h1 class="titre">Inscrivez-vous</h1>
        </div>

        <label class="labelForm">
            <input class="inputForm" name="identifiant" type="text" placeholder="Identifiant"/>
        </label>
        <span class="erreur">
            <?php
            if (isset($traitement) && !$traitement['succes'] 
                && isset($traitement['erreurs']['identifiant'])) {
                echo $traitement['erreurs']['identifiant'];
            }
            ?>
        </span>
        <label class="labelForm">
            <input class="inputForm" name="email" type="text" placeholder="Adresse Mail"/>
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
        <label class="labelForm">
            <input class="inputForm" name="password" type="password" placeholder="Mot de passe"/>
        </label>
        <span class="erreur">
            <?php
            if (isset($traitement) && !$traitement['succes'] 
                && isset($traitement['erreurs']['password'])) {
                echo $traitement['erreurs']['password'];
            }
            ?>
        </span>
        <label class="labelForm">
            <input class="inputForm" type="password" placeholder="Vérification du Mot de passe" name="password-verif"/>
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
        <button class="buttonForm" type="submit">S'inscire</button>
    </form>

    <?php
    if(isset($_POST) && !empty($_POST)){
        $answer = 1;
        foreach($profils as $profil){
            if(($profil['Pseudo_profil'])===($_POST['identifiant'])){
                echo '<span class="erreur">Identifiant déjà utiliser</span>';
                $answer = 0;
            }
        }
        if(empty($_POST['password'])){
            $answer = 0;
        }
        if(($_POST['password'])!=($_POST['password-verif'])){
            $answer = 0;
        }
        if(($answer === 1)){
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
            ajoutProfil($_POST);
            header("Location: ./index.php");
        }
    }
    ?>
<?php require_once('./require/footer.php')?>