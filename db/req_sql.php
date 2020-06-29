<?php 
    require_once('db.php');

    ///=======///
    /// QUESTION ///
    ///=======///

    // récupération données table question 
    function recupQuestions(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `question` ORDER BY `Date_creation_question` DESC");
        $requete->execute();
        $questions = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $questions;
    }
    // récupération données nombre de question 
    function recupNombreQuestions(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT COUNT(*) FROM `question` ORDER BY `Date_creation_question` DESC");
        $requete->execute();
        $questions = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $questions;
    }
    // récupération limite défini de question 
    function recupQuestionsLimite($debut,$fin){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `question` ORDER BY `Date_creation_question` DESC LIMIT $debut,$fin");
        $requete->execute();
        $questions = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $questions;
    }
    // récupération données d'une question (par l'id)
    function recupLaQuestion($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('SELECT * FROM `question` WHERE `Id_question` = :Id_question');
        $requete->bindParam(':Id_question', $idQuestion);
        $idQuestion = $info;
        $requete->execute();
        $laQuestion = $requete->fetch(\PDO::FETCH_ASSOC);
        return $laQuestion;
    }
    // récupération données d'une question (par le titre de la question)
    function recupLaQuestionTitre($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('SELECT * FROM `question` WHERE `Titre_question` = :Titre_question');
        $requete->bindParam(':Titre_question', $question);
        $question = $info;
        $requete->execute();
        $laQuestion = $requete->fetch(\PDO::FETCH_ASSOC);
        return $laQuestion;
    }
    // récupération des questions d'un profil
    function recupQuestionsProfil($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('SELECT * FROM `question` WHERE `#Id_profil` = :Id_profil ORDER BY `Date_creation_question` DESC');
        $requete->bindParam(':Id_profil', $idProfil);
        $idProfil = $info;
        $requete->execute();
        $lesQuestions = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $lesQuestions;
    }
    // récupération des questions privée d'un profil
    function recupQuestionsPrivee($id){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('SELECT * FROM `question` WHERE `#Id_profil` = :Id_profil AND `Visible_question` != :Visible_question');
        $requete->bindParam(':Id_profil', $idProfil);
        $requete->bindParam(':Visible_question', $visibleQuestion);
        $idProfil = $id;
        $visibleQuestion = 'all';
        $requete->execute();
        $lesQuestions = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $lesQuestions;
    }
     // récupération de toutes les questions privée
     function recupAllQuestionsPrivee(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('SELECT * FROM `question` WHERE `Visible_question` != :Visible_question');
        $requete->bindParam(':Visible_question', $visibleQuestion);
        $visibleQuestion = 'all';
        $requete->execute();
        $lesQuestions = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $lesQuestions;
    }

    ///=======///
    /// REPONSE ///
    ///=======///

    // récupération données table réponse
    function recupReponses(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM reponse ORDER BY `Date_reponse` DESC");
        $requete->execute();
        $reponses = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $reponses;
    }
    // récupération nombre de reponse d'une question
    function calculeReponseQuestion($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('SELECT COUNT(*) FROM reponse WHERE `#Id_question` = :Id_question');
        $requete->bindParam(':Id_question', $idQuestion);
        $idQuestion = $info;
        $requete->execute();
        $nombreReponse = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $nombreReponse;
    }

    ///=======///
    /// PROFIL ///
    ///=======///

    // récupération données table profil
    function recupProfils(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `profil`");
        $requete->execute();
        $profils = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $profils;
    }
    // récupération donnée d'un profil (à partir de l'Id)
    function recupLeProfil($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `profil` WHERE `Id_profil` = :Id_profil");
        $requete->bindParam(':Id_profil', $idProfil);
        $idProfil = $info;
        $requete->execute();
        $leProfil = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $leProfil;
    }
    // recherche d'un profil (à partir du pseudo)
    function rechercheProfil($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('SELECT * FROM `profil` WHERE `Pseudo_profil` = :Pseudo_profil');
        $requete->bindParam(':Pseudo_profil', $pseudo);
        $pseudo = $info;
        $requete->execute();
        $leProfil = $requete->fetchAll(\PDO::FETCH_ASSOC);
        if(!empty($leProfil)){
            return True;
        }else{
            return False;
        }
        
    }
    // récupération donnée d'un profil connexion/vérification
    function recupLeProfilConnexion(array $info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `profil` WHERE `Pseudo_profil` = :Pseudo_profil");
        $requete->bindParam(':Pseudo_profil', $pseudo);
        $pseudo = $info['identifiant'];
        $requete->execute();
        $leProfil = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $leProfil;
    }

    ///=======///
    /// CATEGORIE ///
    ///=======///

    // récupération données table catégorie
    function recupAllCategs(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `categorie`");
        $requete->execute();
        $categories = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $categories;
    }

    // récupération données table catégorie (sans la catégorie 'autre')
    function recupCategs(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `categorie` WHERE `Libelle_categorie` != :Libelle_categorie");
        $requete->bindParam('Libelle_categorie', $categorie);
        $categorie = 'autre';
        $requete->execute();
        $categories = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $categories;
    }

    // recherche catégorie
    function rechercheCateg($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `categorie` WHERE `Libelle_categorie` = :Libelle_categorie");
        $requete->bindParam('Libelle_categorie', $categorie);
        $categorie = $info;
        $requete->execute();
        $categories = $requete->fetchAll(\PDO::FETCH_ASSOC);
        if(!empty($categories)){
            return True;
        }else{
            return False;
        }
    }
    // recupération d'une catégorie (par son id)
    function recupUneCateg($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `categorie` WHERE `Id_categorie` = :Id_categorie");
        $requete->bindParam('Id_categorie', $categorie);
        $categorie = $info;
        $requete->execute();
        $categories = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $categories;
    }

    ///=======///
    /// VOTE ///
    ///=======///

    // récupération calcule le nombre de vote d'une question
    function calculeVoteQuestion($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('SELECT COUNT(*) FROM `vote` WHERE `#Id_question` = :Id_question');
        $requete->bindParam(':Id_question', $idQuestion);
        $idQuestion = $info;
        $requete->execute();
        $nombreVote = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $nombreVote;
    }
    // récupération donnée du vote de utilisateur sur la question
    function recupVoteQuestion($info,$id){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('SELECT * FROM `vote` WHERE `#Id_question` = :Id_question AND `#Id_profil` = :Id_profil');
        $requete->bindParam(':Id_question', $idQuestion);
        $requete->bindParam(':Id_profil', $idProfil);
        $idQuestion = $info;
        $idProfil = $id;
        $requete->execute();
        $votes = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $votes;
    }

    ///=======///
    /// AMIS ///
    ///=======///

    // récupération données demande amis
    function recupAmisDemande(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `amis` WHERE `Profil_demande` = :Profil_demande AND `Demande_amis` = 1 ");
        $requete->bindParam(':Profil_demande', $profilDemande);
        $profilDemande = $_SESSION['utilisateur']['pseudo'];
        $requete->execute();
        $amis = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $amis;
    }
    // récupération données invitation amis
    function recupInviteAmis(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `amis` WHERE `Profil_reception` = :Profil_reception AND `Demande_amis` = 1");
        $requete->bindParam(':Profil_reception', $profilReception);
        $profilReception = $_SESSION['utilisateur']['pseudo'];
        $requete->execute();
        $amis = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $amis;
    }
    // récupération données amis
    function recupAmis(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `amis` WHERE (`Profil_demande` = :Profil_demande or `Profil_reception` = :Profil_reception) AND `Demande_amis` = 0 ");
        $requete->bindParam(':Profil_demande', $profilDemande);
        $requete->bindParam(':Profil_reception', $profilReception);
        $profilDemande = $_SESSION['utilisateur']['pseudo'];
        $profilReception = $_SESSION['utilisateur']['pseudo'];
        $requete->execute();
        $amis = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $amis;
    }
    // recherche si déjà amis ou invitation d'amis en cours
    function rechercheAmis(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `amis` WHERE (`Profil_demande` = :Profil_demande or `Profil_reception` = :Profil_reception) AND (`Demande_amis` = 0 or `Demande_amis` = 1)");
        $requete->bindParam(':Profil_demande', $profilDemande);
        $requete->bindParam(':Profil_reception', $profilReception);
        $profilDemande = $_SESSION['utilisateur']['pseudo'];
        $profilReception = $_SESSION['utilisateur']['pseudo'];
        $requete->execute();
        $amis = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $amis;
    }
    // récupération donnée profil (reception ou demande ou amis)
    function recupProfilAmis($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('SELECT `Id_profil`, `Pseudo_profil`, `#Id_role`, `avatar` FROM `profil` WHERE `Pseudo_profil` = :Pseudo_profil');
        $requete->bindParam(':Pseudo_profil', $pseudo);
        $pseudo = $info;
        $requete->execute();
        $leProfil = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $leProfil;
    }

    ///=======///=====================================================================
    /// INSERTION ///=================================================================
    ///=======////====================================================================

    // requête insertion BDD d'une question
    function insertQuestion(array $info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('INSERT INTO `question`(`Titre_question`, `Date_creation_question`, `#Id_profil`, `#Id_categorie`, `unique_key`, `Visible_question`) VALUES (:Titre_question, :Date_creation_question, :FK_Id_profil, :Id_categorie, :unique_key, :Visible_question)');
        $requete->bindParam(':Titre_question', $titreQuestion);
        $requete->bindParam(':Date_creation_question', $dateQuestion);
        $requete->bindParam(':FK_Id_profil', $idFkProfil);
        $requete->bindParam(':Id_categorie', $idCateg);
        $requete->bindParam(':unique_key', $idKey);
        $requete->bindParam(':Visible_question', $visibleQuestion);
        $titreQuestion = $info['question'];
        $dateQuestion = $info['date'];
        $idFkProfil = $_SESSION['utilisateur']['id'];
        $idCateg = $info['inputCateg'];
        $idKey = $info['id_key'];
        $visibleQuestion = $info['friend'];
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

    // requête insertion BDD d'un vote
    function ajoutVote(array $info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('INSERT INTO `vote`(`Action_vote`, `#Id_question`, `#Id_profil`) VALUES (:Action_vote, :Fk_Id_question, :Fk_Id_profil)');
        $requete->bindParam(':Action_vote', $actionVote);
        $requete->bindParam(':Fk_Id_question', $idFkQuestion);
        $requete->bindParam(':Fk_Id_profil', $idFkProfil);
        $actionVote = $info['vote'];
        $idFkQuestion = $info['id_question'];
        $idFkProfil = $info['id_profil'];
        $requete->execute();
    }

    // requête insertion BDD d'une demande d'amis
    function ajoutDemandeAmis($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('INSERT INTO `amis`(`Profil_demande`, `Profil_reception`) VALUES (:Profil_demande, :Profil_reception)');
        $requete->bindParam(':Profil_demande', $profilDemande);
        $requete->bindParam(':Profil_reception', $profilReception);
        $profilDemande = $_SESSION['utilisateur']['pseudo'];
        $profilReception = $info;
        $requete->execute();
        ?>
        <script>
                document.location.href="./home.php";
        </script>
        <?php
    }

    // requête insertion BDD d'une catégorie
    function ajoutCateg($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('INSERT INTO `categorie`(`Libelle_categorie`) VALUES (:Libelle_categorie)');
        $requete->bindParam(':Libelle_categorie', $categorie);
        $categorie = $info;
        $requete->execute();
        ?>
        <script>
                document.location.href="./gestion-categorie.php";
        </script>
        <?php
    }

    
    ///=======///=====================================================================
    /// MODIFICATION ///==============================================================
    ///=======///=====================================================================

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
        ?>
        <script>
            document.location.href="page-perso-profil.php";
        </script>
        <?php
    }
    // requête modification BDD acceptation d'invitation d'amis
    function valideInvite($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('UPDATE amis SET Demande_amis = :Demande_amis WHERE Id_amis = :Id_amis');
        $requete->bindParam(':Demande_amis', $valide);
        $requete->bindParam(':Id_amis', $idAmis);
        $valide = 0;
        $idAmis = $info;
        $requete->execute();

    }
    if(!empty($_GET['id_ami'])){
        valideInvite($_GET['id_ami']);
    ?>
    <script>
            document.location.href="../home.php";
    </script>
    <?php
    }

    // requête après suppression de l'amis, suppression de l'amis de toute les questions privée (de l'utilisateur qui l'a supprimer)
    // (modification de liste des utilisateur accessible à la question privée)
    function modifQuestionPrivee($info,$id){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('UPDATE question SET Visible_question = :Visible_question WHERE Id_question = :Id_question');
        $requete->bindParam(':Visible_question', $visibleQuestion);
        $requete->bindParam(':Id_question', $idQuestion);
        $visibleQuestion = $info;
        $idQuestion = $id;
        $requete->execute();
    }

    // modification des catégories des questions
    function modifCategQuestion($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('UPDATE question SET `#Id_categorie` = :autre WHERE `#Id_categorie` = :Id_categorie');
        $requete->bindParam(':Id_categorie', $idCategorie);
        $requete->bindParam(':autre', $default);
        $idCategorie = $info;
        $default = 0;
        $requete->execute();
    }
    // requête suppression des votes de l'amis supprimer, sur les questions privée
    function suppCategs($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('DELETE FROM `categorie` WHERE `Id_categorie` = :Id_categorie');
        $requete->bindParam(':Id_categorie', $IdCategorie);
        $IdCategorie = $info;
        $requete->execute();
    }
?>
