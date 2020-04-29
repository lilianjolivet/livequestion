<?php
    require_once('req_sql.php');

//suppression de la question avec ses réponses et ses votes (ADMINISTRATION)
if(isset($_GET['id_supp_question']) && !empty($_GET['id_supp_question'])){
    $id = $_GET['id_supp_question'];
    suppReponse($id);
    suppVoteQuestion($id);
    suppQuestion($id);
    header('Location: ../administration.php');
}

//suppression du profil & img avatar du profil stocker (DESINCRIPTION)
$idSupp = $_GET['id_supp'];

if(isset($idSupp)&&!empty($idSupp)){
    $lesQuestions = recupQuestionsProfil($idSupp);
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
?>