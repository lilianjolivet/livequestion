<?php 
    require_once('./require/header.php');
?>
<body class="bodyForm">
    <?php
    require_once('./db/req_sql.php');
    $profils = recupProfil();

    require_once('./traitement/traitement_formulaire.php');
        if(!empty($_POST)){
            $traitement = traitementFormulaireConnexion($_POST);
        }
    ?>
    <form class="formContactIncri" action="#" method="POST">

        <div class="segment">
            <h1 class="titre">Connectez-vous</h1>
        </div>

        <label class="labelForm">
            <input class="inputForm" type="text" placeholder="identifiant" name="identifiant"/>
        </label>
        <span class="erreur">
            <?php
            if (isset($traitement) && !$traitement['succes'] 
                && isset($traitement['erreurs']['identifiant'])){
                echo $traitement['erreurs']['identifiant'];
            }
            ?>
        </span>
        <label class="labelForm">
            <input class="inputForm" type="password" placeholder="Mot de passe" name="password"/>
        </label>
        <span class="erreur">
            <?php
            if (isset($traitement) && !$traitement['succes'] 
                && isset($traitement['erreurs']['password'])){
                echo $traitement['erreurs']['password'];
            }
            ?>
        </span>
        <button class="buttonForm" type="submit">Se connecter</button>
        <a id="btn-connexion" href="inscription.php"><button class="buttonForm" type="button">S'inscrire</button></a>
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
<?php require_once('./require/footer.php')?>