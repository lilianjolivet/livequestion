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
    // récupération limite défini de questions 
    function recupQuestionsLimite($debut,$fin){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `question` ORDER BY `Date_creation_question` DESC LIMIT $debut,$fin");
        $requete->execute();
        $questions = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $questions;
    }
    // récupération données d'une question
    function recupLaQuestion($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('SELECT * FROM `question` WHERE `Id_question` = :Id_question');
        $requete->bindParam(':Id_question', $idQuestion);
        $idQuestion = $info;
        $requete->execute();
        $laQuestion = $requete->fetchAll(\PDO::FETCH_ASSOC);
        return $laQuestion;
    }
    // récupération des questions d'un profil
    function recupQuestionsProfil($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('SELECT * FROM `question` WHERE `#Id_profil` = :Id_profil');
        $requete->bindParam(':Id_profil', $idProfil);
        $idProfil = $info;
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
    function recupCategs(){
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `categorie`");
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
    // récupération données de vote d'une question
    function recupVotesQuestion($info){
        $connexion = connexionBdd();

        $requete = $connexion->prepare('SELECT * FROM `vote` WHERE `#Id_question` = :Id_question');
        $requete->bindParam(':Id_question', $idQuestion);
        $idQuestion = $info;
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

    ///=======///
    /// INSERTION ///
    ///=======////

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

    ///=======///
    /// MODIFICATION ///
    ///=======////

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
?>
