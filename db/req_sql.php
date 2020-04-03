<?php 
    require_once('./db/db.php');

    // récupération données question 
    function recupQuestion(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `question` ORDER BY `Date_creation_question` DESC");
        $requete->execute();
        $questions = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $questions;
    }

    // récupération données réponse
    function recupReponse(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM reponse ORDER BY `Date_reponse` DESC");
        $requete->execute();
        $reponses = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $reponses;
    }

    // récupération données profil
    function recupProfil(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `profil`");
        $requete->execute();
        $profils = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $profils;
    }

    // récupération données catégorie
    function recupCateg(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `categorie`");
        $requete->execute();
        $categories = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $categories;
    }

    // requête insertion BDD d'une question
    function insertQuestion(array $info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('INSERT INTO `question`(`Titre_question`, `Date_creation_question`, `#Id_profil`, `#Id_categorie`, `unique_key`) VALUES (:Titre_question, :Date_creation_question, :FK_Id_profil, :Id_categorie, :unique_key)');
        $requete->bindParam(':Titre_question', $titreQuestion);
        $requete->bindParam(':Date_creation_question', $dateQuestion);
        $requete->bindParam(':FK_Id_profil', $idFkProfil);
        $requete->bindParam(':Id_categorie', $idCateg);
        $requete->bindParam(':unique_key', $idKey);
        $titreQuestion = $info['question'];
        $dateQuestion = $info['date'];
        $idFkProfil = $_SESSION['utilisateur']['id'];
        $idCateg = $info['inputCateg'];
        $idKey = $info['id_key'];
        $requete->execute();
    }

    // requête insertion BDD d'une réponse
    function insertReponse(array $info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('INSERT INTO `reponse`(`Contenu_reponse`, `Date_reponse`, `#Id_profil`,`#Id_question`, `#unique_key`) VALUES (:Contenu_reponse, :Date_reponse, :FK_Id_profil,:FK_Id_question, :FK_unique_key)');
        $requete->bindParam(':Contenu_reponse', $contenuReponse);
        $requete->bindParam(':Date_reponse', $dateReponse);
        $requete->bindParam(':FK_Id_profil', $idFkProfil);
        $requete->bindParam(':FK_Id_question', $idFkQuestion);
        $requete->bindParam(':FK_unique_key', $idFkKey);
        $contenuReponse = $info['reponse'];
        $dateReponse = $info['date'];
        $idFkProfil = $_SESSION['utilisateur']['id'];
        $idFkQuestion = $info['id_fk_question'];
        $idFkKey = $info['fk_key'];
        $requete->execute();
    }

    // requête insertion BDD d'un profil
    function ajoutProfil(array $info) {
        $connexion = connexionBdd();

        $requete = $connexion->prepare('INSERT INTO `profil`(`Pseudo_profil`, `Mail_profil`, `MotDePasse_profil`, `Genre_profil`, `#Id_role`) VALUES (:Pseudo_profil, :Mail_profil, :MotDePasse_profil, :Genre_profil, :Fk_Id_role)');
        $requete->bindParam(':Pseudo_profil', $pseudo);
        $requete->bindParam(':Mail_profil', $mail);
        $requete->bindParam(':MotDePasse_profil', $motDePasse);
        $requete->bindParam(':Genre_profil', $genre);
        $requete->bindParam(':Fk_Id_role', $fkRole);
        $pseudo = $info['identifiant'];
        $mail = $info['email'];
        $motDePasse = $info['password'];
        $genre = $info['sexe'];
        $fkRole = 1;
        $requete->execute();
    }

    // requête modification BDD d'un profil
    function modifProfil(array $info){
        $connexion = connexionBdd();

        if(!empty($info['avatar']) && !empty($info['id'])){
            $requete = $connexion->prepare('UPDATE profil SET avatar = :avatar WHERE Id_profil = :Id_profil');
            $requete->bindParam(':avatar', $avatar);
            $requete->bindParam(':Id_profil', $idProfil);
            $avatar = $info['avatar'];
            $idProfil = $info['id'];
            $requete->execute();
        }
        if(!empty($info['identifiant'])){
            $requete = $connexion->prepare('UPDATE profil SET Pseudo_profil = :Pseudo_profil WHERE Id_profil = :Id_profil');
            $requete->bindParam(':Pseudo_profil', $pseudo);
            $requete->bindParam(':Id_profil', $idProfil);
            $pseudo = $info['identifiant'];
            $idProfil = $_SESSION['utilisateur']['id'];
            $requete->execute();
        }
        if(!empty($info['email'])){
            $requete = $connexion->prepare('UPDATE profil SET Mail_profil = :Mail_profil WHERE Id_profil = :Id_profil');
            $requete->bindParam(':Mail_profil', $mail);
            $requete->bindParam(':Id_profil', $idProfil);
            $mail = $info['email'];
            $idProfil = $_SESSION['utilisateur']['id'];
            $requete->execute();
        }
        if(!empty($info['password'])){
            $requete = $connexion->prepare('UPDATE profil SET MotDePasse_profil = :MotDePasse_profil WHERE Id_profil = :Id_profil');
            $requete->bindParam(':MotDePasse_profil', $mdp);
            $requete->bindParam(':Id_profil', $idProfil);
            $mdp = $info['password'];
            $idProfil = $_SESSION['utilisateur']['id'];
            $requete->execute();
        }
        header('Location: ./page-perso-profil.php');
    }
?>

