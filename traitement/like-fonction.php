<?php
    require_once('../db/req_sql.php');
    require_once('../db/req_supp_sql.php');
    
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
        $nombreVote = $_GET['nbe'];
        switch($vote){
            case 1:
                ajoutVote($donneeVote);
                    ?>
                    <div class="footer-question">
                        <button type="button" class="btn-like like-on" href = "./traitement/like-fonction.php?vote=<?php echo $vote + 1?>&amp;id_question=<?php echo $idQuestion?>&amp;nbe=<?php echo $nombreVote + 1?>">
                            <i class="fas fa-heart"></i>
                        </button>
                        <span><?php echo $nombreVote + 1?></span> 
                    </div>
                    <?php
                break;
            case 2:
                suppVote($donneeVote);
                    ?>
                    <div class="footer-question">
                        <button type="button" class="btn-like" href = "./traitement/like-fonction.php?vote=<?php echo $vote - 1?>&amp;id_question=<?php echo $idQuestion?>&amp;nbe=<?php echo $nombreVote - 1?>">
                            <i class="far fa-heart"></i>
                        </button> 
                        <span><?php echo $nombreVote - 1?></span> 
                    </div>
                    <?php
                break;
        }
    }
    // traitement des likes et des unlikes (question privée)
    if(!empty($_GET['vote_private'])){
        //données pour le vote
        $id = $_SESSION['utilisateur']['id'];
        $vote = $_GET['vote_private'];
        $idQuestion = $_GET['id_question'];
        $donneeVote = [
            'id_profil' => $id,
            'vote' => $vote,
            'id_question' => $idQuestion,
        ];
        $nombreVote = $_GET['nbe'];
        switch($vote){
            case 1:
                ajoutVote($donneeVote);
                    ?>
                    <div class="footer-question">
                        <button type="button" class="btn-like like-on-friend" href = "./traitement/like-fonction.php?vote_private=<?php echo $vote + 1?>&amp;id_question=<?php echo $idQuestion?>&amp;nbe=<?php echo $nombreVote + 1?>">
                            <i class="fas fa-heart"></i>
                        </button>
                        <span><?php echo $nombreVote + 1?></span> 
                    </div>
                    <?php
                break;
            case 2:
                suppVote($donneeVote);
                    ?>
                    <div class="footer-question">
                        <button type="button" class="btn-like" href = "./traitement/like-fonction.php?vote_private=<?php echo $vote - 1?>&amp;id_question=<?php echo $idQuestion?>&amp;nbe=<?php echo $nombreVote - 1?>">
                            <i class="far fa-heart"></i>
                        </button> 
                        <span><?php echo $nombreVote - 1?></span> 
                    </div>
                    <?php
                break;
        }
    }
?>
