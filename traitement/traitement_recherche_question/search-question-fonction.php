<?php
    session_start();
    require_once('../../db/db.php');
    //requete bar de recherche question BDD
    if(isset($_POST['search'])){
        $connexion = connexionBdd();
        $connexion = connexionBdd();
        $search = $_POST['search'];
        $search = addslashes($search);  
  
        $requete = "SELECT * FROM question WHERE Titre_question like'%".$search."%'";
        $requete = $connexion->prepare("SELECT * FROM question WHERE Titre_question like'%".$search."%'");
        $requete->execute();
        $results = $requete->fetchAll(\PDO::FETCH_ASSOC);

        $response = array();
        foreach($results as $result){
            if($result['Visible_question'] !== 'all'){
                $amis = explode(':',$result['Visible_question']);
                if(in_array($_SESSION['utilisateur']['id'],$amis) || $_SESSION['utilisateur']['id'] === $result['#Id_profil']){
                    $response[] = array(
                        "label"=>$result['Titre_question'],
                    );
                }
            }else{
                $response[] = array(
                    "label"=>$result['Titre_question'],
                );
            }
        }
        if(empty($response)){
            $response[] = array(
                "label"=>'Pas de suggestion',
            );
        }
        echo json_encode($response);
    }
exit;

?>