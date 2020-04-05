<?php
    require_once('req_sql.php');
    $questions = recupQuestion();
    $profils = recupProfil();
    $reponses = recupReponse();
    $votes = recupVote();

//suppression de la question avec ses réponses et ses votes
if(isset($_GET['id_supp_question']) && !empty($_GET['id_supp_question'])){
    $id = $_GET['id_supp_question'];
    suppReponse($id);
    suppVoteQuestion($id);
    suppQuestion($id);
    header('Location: ../administration.php');
}

//suppression du profil & img avatar du profil stocker
$idSupp = $_GET['id_supp'];

if(isset($idSupp)&&!empty($idSupp)){
    foreach($questions as $question){
        if($idSupp == $question['#Id_profil']){
            foreach($reponses as $reponse){
                if($question['Id_question'] == $reponse['#Id_question']){
                    suppReponse($reponse['#Id_question']);
                }
                suppReponseProfil($idSupp);
            }
            foreach($votes as $vote){
                if($idSupp == $vote['#Id_profil']){
                    suppVoteProfil($idSupp);
                }
            }
            suppQuestionProfil($idSupp);
        }
    }
    //si le profil n'avait pas ajouter de question
    foreach($reponses as $reponse){
        if($idSupp == $reponse['#Id_profil']){
            suppReponseProfil($idSupp);
        }
    }
    foreach($votes as $vote){
        if($idSupp == $vote['#Id_profil']){
            suppVoteProfil($idSupp);
        }
    }
    //suppression des avatars stocker du profil
    $extensions = ['jpg', 'jpeg', 'gif', 'png'];
    $chemin = '';
    foreach($profils as $profil){
        if($idSupp == $profil['Id_profil']){
            $chemin = '../images/avatars/'.$profil['Id_profil'];
        }
    }
    foreach($extensions as $extension){
        if($profil['avatar'] != 'default.jpg' ){
            $file = $chemin.'.'.$extension;
            if(isset($file)){
                unlink($file);
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