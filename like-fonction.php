<?php
    session_start();
    require_once('./db/req_sql.php');
    require_once('./db/req_supp_sql.php');
    
    // traitement des likes et des unlikes 
    if(!empty($_GET['vote'])){
        //données pour le vote
        $id = $_SESSION['utilisateur']['id'];
        $vote = $_GET['vote'];
        $idQuestion = $_GET['id_question'];
        $donneeVote = [
            'id_profil' => $id,
            'vote' => $vote,
            'id_question' => $idQuestion,
        ];
        //données pour renvoyer vers la page profil-membre
        $idProfilQuestion = $_GET['id_profil_question'];

        //données chemin de la page
        $adresse = $_GET['ad'];
       
        switch($adresse){
            case'affichage-question':
                $adresse = 'Location: ./home.php';
                break;
            case'profil-membre':
                $adresse = 'Location: ./profil-membre.php?id='.$idProfilQuestion;
                break;
            case'page-perso-question':
                $adresse = 'Location: ./page-perso-question.php?id='.$idQuestion;
                break;
        }
        switch($vote){
            case 1:
                ajoutVote($donneeVote);
                header($adresse);
                break;
            case 2:
                suppVote($donneeVote);
                header($adresse);
                break;
        }
    }
?>
