<?php 

require_once('./db/db.php');

// récupération données question 
function recupQuestion(){
    $connexion = connexionBdd();

    $requete = $connexion->prepare("SELECT * FROM question");
    $requete->execute();
    $questions = $requete->fetchAll(\PDO::FETCH_ASSOC);
    return $questions;
}

// récupération données réponse
function recupReponse(){
    $connexion = connexionBdd();

    $requete = $connexion->prepare("SELECT * FROM reponse");
    $requete->execute();
    $reponses = $requete->fetchAll(\PDO::FETCH_ASSOC);
    return $reponses;
}

// récupération données profil
function recupProfil(){
    $connexion = connexionBdd();

    $requete = $connexion->prepare("SELECT `Id_profil`, `Pseudo_profil` FROM `profil` WHERE 1 ");
    $requete->execute();
    $profils = $requete->fetchAll(\PDO::FETCH_ASSOC);
    return $profils;
}

// récupération données catégorie
function recupCateg(){
    $connexion = connexionBdd();

    $requete = $connexion->prepare("SELECT * FROM `categorie` ");
    $requete->execute();
    $categories = $requete->fetchAll(\PDO::FETCH_ASSOC);
    return $categories;
}

// requête insertion BDD d'une question
function insertQuestion(array $info){
    $connexion = connexionBdd();

    $requete = $connexion->prepare('INSERT INTO `question`(`Titre_question`, `Date_creation_question`, `#Id_categorie`,  `unique_key`) VALUES (:Titre_question, :Date_creation_question, :Id_categorie, :unique_key)');
    $requete->bindParam(':Titre_question', $titre_question);
    $requete->bindParam(':Date_creation_question', $date_question);
    $requete->bindParam(':Id_categorie', $id_categ);
    $requete->bindParam(':unique_key', $id_key);
    $titre_question = $info['question'];
    $date_question = $info['date'];
    $id_categ = $info['inputCateg'];
    $id_key = $info['id_key'];
    $requete->execute();
}
// requête insertion BDD d'une réponse
function insertReponse(array $info){
    $connexion = connexionBdd();

    $requete = $connexion->prepare('INSERT INTO `reponse`(`Contenu_reponse`, `Date_reponse`, `#Id_question`, `#unique_key`) VALUES (:Contenu_reponse, :Date_reponse, :FK_Id_question, :FK_unique_key)');
    $requete->bindParam(':Contenu_reponse', $contenu_reponse);
    $requete->bindParam(':Date_reponse', $date_reponse);
    $requete->bindParam(':FK_Id_question', $id_fk_question);
    $requete->bindParam(':FK_unique_key', $id_fk_key);
    $contenu_reponse = $info['reponse'];
    $date_reponse = $info['date'];
    $id_fk_question = $info['id_fk_question'];
    $id_fk_key = $info['fk_key'];
    $requete->execute();
}


?>

