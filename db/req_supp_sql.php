<?php
    session_start();
    require_once('req_sql.php');

//suppression de l'amis 
if(!empty($_GET['id_supp_amitie'])){
    //suppression des données de l'amis sur toutes les questions privées où il est autoriser (reponse/vote)(acces refuser)
    $lesQuestionsPrivee = recupQuestionsPrivee($_SESSION['utilisateur']['id']);
    if(!empty($lesQuestionsPrivee)){
        foreach($lesQuestionsPrivee as $questionPrivee){
            $lesAmis = explode(':',$questionPrivee['Visible_question']);
            $positionAmis = array_search($_GET['id_supp_amis'],$lesAmis);
            if($positionAmis !== false){
                array_splice($lesAmis,$positionAmis,1);
                $lesAmis = implode(":",$lesAmis);
                modifQuestionPrivee($lesAmis,$questionPrivee['Id_question']);
                suppVotePrivee($questionPrivee['Id_question'],$_GET['id_supp_amis']);
                suppReponsePrivee($questionPrivee['Id_question'],$_GET['id_supp_amis']);
                if(empty($lesAmis)){
                    suppQuestion($questionPrivee['Id_question']);
                }
            }
        }
    }
    //suppression de nos données sur toutes les questions privées de l'amis supprimer où nous étions autoriser (reponse/vote)(acces refuser)
    $lesQuestionsPrivee = recupQuestionsPrivee($_GET['id_supp_amis']);
    if(!empty($lesQuestionsPrivee)){
        foreach($lesQuestionsPrivee as $questionPrivee){
            $lesAmis = explode(':',$questionPrivee['Visible_question']);
            $positionAmis = array_search($_SESSION['utilisateur']['id'],$lesAmis);
            if($positionAmis !== false){
                array_splice($lesAmis,$positionAmis,1);
                $lesAmis = implode(":",$lesAmis);
                modifQuestionPrivee($lesAmis,$questionPrivee['Id_question']);
                suppVotePrivee($questionPrivee['Id_question'],$_SESSION['utilisateur']['id']);
                suppReponsePrivee($questionPrivee['Id_question'],$_SESSION['utilisateur']['id']);
                if(empty($lesAmis)){
                    suppQuestion($questionPrivee['Id_question']);
                }
            }
        }
    }
    suppAmis($_GET['id_supp_amitie']);
    ?> 
    <script>document.location.href="../home.php"</script>
    <?php
}
//suppression de l'invitation d'amis
if(!empty($_GET['id_supp_invite'])){
    suppAmis($_GET['id_supp_invite']);
    ?> 
    <script>document.location.href="../home.php"</script>
    <?php
}

//suppression de la question avec ses réponses et ses votes (ADMINISTRATION)
if(isset($_GET['id_supp_question']) && !empty($_GET['id_supp_question'])){
    $id = $_GET['id_supp_question'];
    suppReponse($id);
    suppVoteQuestion($id);
    suppQuestion($id);
    header('Location: ../gestion-question.php');
}

//suppression du profil & img avatar du profil stocker (DESINCRIPTION)
if(isset($_GET['id_supp'])&&!empty($_GET['id_supp']) && isset($_GET['pseudo_supp']) && !empty($_GET['pseudo_supp'])){
    $idSupp = $_GET['id_supp'];
    $lesQuestions = recupQuestionsProfil($idSupp);
    $allQuestionsPrivee = recupAllQuestionsPrivee();
    // enlève la référence du profil des questions privée où il avait acces (suppression des reponses et des votes aussi)
    if(!empty($allQuestionsPrivee)){
        foreach($allQuestionsPrivee as $questionPrivee){
            $lesAmis = explode(':',$questionPrivee['Visible_question']);
            $positionAmis = array_search($idSupp,$lesAmis);
            if($positionAmis !== false){
                array_splice($lesAmis,$positionAmis,1);
                $lesAmis = implode(":",$lesAmis);
                suppVotePrivee($questionPrivee['Id_question'],$idSupp);
                suppReponsePrivee($questionPrivee['Id_question'],$idSupp);
                modifQuestionPrivee($lesAmis,$questionPrivee['Id_question']);
                if(empty($lesAmis)){
                    suppQuestion($questionPrivee['Id_question']);
                }
            }
        }
    }
    if(isset($lesQuestions)&&!empty($lesQuestions)){
        foreach($lesQuestions as $laQuestion){
            suppReponse($laQuestion['Id_question']);
            suppVoteQuestion($laQuestion['Id_question']);
        }
        suppVoteProfil($idSupp);
        suppReponseProfil($idSupp);
        suppQuestionProfil($idSupp);
    }else{
        suppReponseProfil($idSupp);
        suppVoteProfil($idSupp);
    }
    suppAllAmis($_GET['pseudo_supp']);
    //suppression des avatars stocker du profil
    $extensions = ['jpg', 'jpeg', 'gif', 'png'];
    $chemin = '../images/avatars/'.$idSupp;
    $leProfil = recupLeProfil($idSupp);
    if($leProfil[0]['avatar'] != 'default.jpg' ){
        foreach($extensions as $extension){
            $file = $chemin.'.'.$extension;
            if(isset($file)){
                if(file_exists($file)){
                    unlink($file);
                }
            }
        }  
    }
    suppProfil($idSupp);
?> 
    <script>document.location.href="../require/logout.php"</script>
<?php
}

// requête suppression d'une question et d'une réponse BDD
function suppReponse($info){
    $connexion = connexionBdd();

    $requete = $connexion->prepare('DELETE FROM `reponse` WHERE `#Id_question` = :fk_id_question');
    $requete->bindParam(':fk_id_question', $idQuestion);
    $idQuestion = $info;
    $requete->execute();
}
function suppQuestion($info){
    $connexion = connexionBdd();
    
    $requete = $connexion->prepare('DELETE FROM `question` WHERE `Id_question` = :id_question');
    $requete->bindParam(':id_question', $idQuestion);
    $idQuestion = $info;
    $requete->execute();
}

// requête suppression profil (suppression du profil / ses questions / ses réponses) BDD
function suppReponseProfil($info){
    $connexion = connexionBdd();

    $requete = $connexion->prepare('DELETE FROM `reponse` WHERE `#Id_profil` = :fk_id_profil');
    $requete->bindParam(':fk_id_profil', $idProfil);
    $idProfil = $info;
    $requete->execute();
}
function suppQuestionProfil($info){
    $connexion = connexionBdd();

    $requete = $connexion->prepare('DELETE FROM `question` WHERE `#Id_profil` = :fk_id_profil');
    $requete->bindParam(':fk_id_profil', $idProfil);
    $idProfil = $info;
    $requete->execute();
}
function suppProfil($info){
    $connexion = connexionBdd();

    $requete = $connexion->prepare('DELETE FROM `profil` WHERE `Id_profil` = :Id_profil');
    $requete->bindParam(':Id_profil', $idProfil);
    $idProfil = $info;
    $requete->execute();
}

///=======///
/// VOTE ///
///=======///

// requête suppression des votes des questions du profil (avant suppression du profil) BDD 
function suppVoteProfil($info){
    $connexion = connexionBdd();

    $requete = $connexion->prepare('DELETE FROM `vote` WHERE `#Id_profil` = :fk_id_profil');
    $requete->bindParam(':fk_id_profil', $idProfil);
    $idProfil = $info;
    $requete->execute();
}

// requête suppression vote BDD effet click/unclick
function suppVote(array $info){
    $connexion = connexionBdd();

    $requete = $connexion->prepare('DELETE FROM `vote` WHERE `#Id_profil` = :fk_id_profil AND `#Id_question` = :fk_id_question');
    $requete->bindParam(':fk_id_profil', $idProfil);
    $requete->bindParam(':fk_id_question', $idQuestion);
    $idProfil = $info['id_profil'];
    $idQuestion = $info['id_question'];
    $requete->execute();
}

// requête suppression des vote d'une question BDD 
function suppVoteQuestion($info){
    $connexion = connexionBdd();

    $requete = $connexion->prepare('DELETE FROM `vote` WHERE `#Id_question` = :fk_id_question');
    $requete->bindParam(':fk_id_question', $idQuestion);
    $idQuestion = $info;
    $requete->execute();
}

///=======///
/// AMIS ///
///=======///

// requête suppression (invitation amis ou amis)
function suppAmis($info){
    $connexion = connexionBdd();

    $requete = $connexion->prepare('DELETE FROM `amis` WHERE `Id_amis` = :Id_amis');
    $requete->bindParam(':Id_amis', $idAmis);
    $idAmis = $info;
    $requete->execute();
}

// requête suppression de tout les amis (invitation amis ou amis)
function suppAllAmis($info){
    $connexion = connexionBdd();

    $requete = $connexion->prepare('DELETE FROM `amis` WHERE (`Profil_demande` = :Profil_demande or `Profil_reception` = :Profil_reception)');
    $requete->bindParam(':Profil_demande', $profilDemande);
    $requete->bindParam(':Profil_reception', $profilReception);
    $profilDemande = $info;
    $profilReception = $info;
    $requete->execute();
}

// requête suppression des reponses de l'amis supprimer, sur les questions privée
function suppReponsePrivee($info,$id){
    $connexion = connexionBdd();

    $requete = $connexion->prepare('DELETE FROM `reponse` WHERE `#Id_profil` = :fk_id_profil AND `#Id_question` = :fk_id_question');
    $requete->bindParam(':fk_id_profil', $idProfil);
    $requete->bindParam(':fk_id_question', $idQuestion);
    $idQuestion = $info;
    $idProfil = $id;
    $requete->execute();
}

// // requête suppression des votes de l'amis supprimer, sur les questions privée
function suppVotePrivee($info,$id){
    $connexion = connexionBdd();

    $requete = $connexion->prepare('DELETE FROM `vote` WHERE `#Id_profil` = :fk_id_profil AND `#Id_question` = :fk_id_question');
    $requete->bindParam(':fk_id_profil', $idProfil);
    $requete->bindParam(':fk_id_question', $idQuestion);
    $idQuestion = $info;
    $idProfil = $id;
    $requete->execute();
}
