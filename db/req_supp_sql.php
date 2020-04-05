<?php
    require_once('req_sql.php');
    $questions = recupQuestion();
    $profils = recupProfil();
    $reponses = recupReponse();


if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    suppReponse($id);
    suppQuestion($id);
    header('Location: ../administration.php');
}
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
            suppQuestionProfil($idSupp);
        }
    }
    $extensions = ['jpg', 'jpeg', 'gif', 'png'];
    $chemin = '';
    foreach($profils as $profil){
        if($idSupp == $profil['Id_profil']){
            $chemin = '../images/avatars/'.$profil['Id_profil'];
        }
    }
    foreach($extensions as $extension){
        $file = $chemin.'.'.$extension;
        if(isset($file)){
            unlink($file);
        }
    }
    suppProfil($idSupp);
    header('Location: ../require/logout.php');
}


// requête supression questions et réponses BDD
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

// requête suppresion profil BDD
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
?>