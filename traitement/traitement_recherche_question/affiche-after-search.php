<?php
session_start();
require_once('../../db/req_sql.php');

function isAjax(){
    return isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}
//traitement de la requete ajax de la question selectionner, puis affichage de celle-ci
if(isAjax()){
    if(isset($_POST['search']) && !empty($_POST['search'])){
        if($_POST['search'] === 'Pas de suggestion'){
            echo '3';
        }else{
            $laQuestion = recupLaQuestionTitre($_POST['search']);
            if(empty($laQuestion)){
                echo '2';
            }else{
                if($laQuestion['Visible_question'] !== 'all'){
                    $amis = explode(':',$laQuestion['Visible_question']);
                    if(in_array($_SESSION['utilisateur']['id'],$amis) !== true && $_SESSION['utilisateur']['id'] !== $laQuestion['#Id_profil']){
                        echo '3';
                    }else{
                        $leProfil = recupLeProfil($laQuestion['#Id_profil']);
                        ?>
                            <div class="container search-answer-container">
                                <div class="row">
                                    <div class="question">
                                        <div class="info-question">
                                            <div class="heading-question">
                                                <img src="./images/avatars/<?php echo $leProfil[0]['avatar']?>" alt="<?php echo $leProfil[0]['avatar']?>" class="rounded avatar-option"> 
                                                <p>
                                                    <a href="profil-membre.php?
                                                        id=<?php echo $leProfil[0]['Id_profil']?>">
                                                        <?php echo $leProfil[0]['Pseudo_profil']?>
                                                    </a>
                                                </p>
                                                <p><i class="far fa-comment-dots"></i>
                                                    <?php
                                                        $nombreReponse = calculeReponseQuestion($laQuestion['Id_question']);
                                                        echo $nombreReponse[0]['COUNT(*)'];
                                                    ?>
                                                </p>
                                                <?php $laCategorie = recupUneCateg($laQuestion['#Id_categorie']); ?>
                                                <p><i class="fas fa-tag"></i><?php echo $laCategorie[0]['Libelle_categorie']?></p>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="bubble bubble-friend">
                                                <div class="body-question">
                                                    <div class="title-question">
                                                    <h2 class="text-break"><a href="page-perso-question.php?
                                                    id=<?php echo $laQuestion['Id_question']?>">
                                                    <?php echo $laQuestion['Titre_question']?></a></h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="footer-question">
                                            <?php
                                            // fonction like en liens avec la page like-fonction.php
                                            $leVote = 0;
                                            $couleurOn = " ";
                                            $nombreVote = calculeVoteQuestion($laQuestion['Id_question']);
                                            $leVote = recupVoteQuestion($laQuestion['Id_question'],$_SESSION['utilisateur']['id']);
                                            if(isset($leVote) && !empty($leVote)){
                                                $leVote = $leVote[0]['Action_vote'];
                                                $couleurOn = "fas fa-heart like-on-friend";
                                                $leVote = $leVote + 1;
                                            }else{
                                                $leVote = 1;
                                            }
                                            $adresse = 'affichage-question';
                                            ?>
                                                <button type="button" class="btn-like" href = "./traitement/like-fonction.php?vote_private=<?php echo $leVote?>&amp;id_question=<?php echo $laQuestion['Id_question']?>&amp;nbe=<?php echo $nombreVote[0]['COUNT(*)']?>">
                                                    <i class="<?php 
                                                        if($leVote === 1){
                                                            $couleurOn = "far fa-heart";
                                                        }
                                                        echo $couleurOn;
                                                    ?>"></i>
                                                </button>
                                                <span><?php echo $nombreVote[0]['COUNT(*)']?></span> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }else{
                    $leProfil = recupLeProfil($laQuestion['#Id_profil']);
                ?>
                    <div class="container search-answer-container">
                        <div class="row">
                            <div class="question">
                                <div class="info-question">
                                    <div class="heading-question">
                                        <img src="./images/avatars/<?php echo $leProfil[0]['avatar']?>" alt="<?php echo $leProfil[0]['avatar']?>" class="rounded avatar-option"> 
                                        <p>
                                            <a href="profil-membre.php?
                                                id=<?php echo $leProfil[0]['Id_profil']?>">
                                                <?php echo $leProfil[0]['Pseudo_profil']?>
                                            </a>
                                        </p>
                                        <p><i class="far fa-comment-dots"></i>
                                            <?php
                                                $nombreReponse = calculeReponseQuestion($laQuestion['Id_question']);
                                                echo $nombreReponse[0]['COUNT(*)'];
                                            ?>
                                        </p>
                                        <?php $laCategorie = recupUneCateg($laQuestion['#Id_categorie']); ?>
                                        <p><i class="fas fa-tag"></i><?php echo $laCategorie[0]['Libelle_categorie']?></p>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="bubble">
                                        <div class="body-question">
                                            <div class="title-question">
                                            <h2 class="text-break"><a href="page-perso-question.php?
                                            id=<?php echo $laQuestion['Id_question']?>">
                                            <?php echo $laQuestion['Titre_question']?></a></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="footer-question">
                                    <?php
                                    // fonction like en liens avec la page like-fonction.php
                                    $leVote = 0;
                                    $couleurOn = " ";
                                    $nombreVote = calculeVoteQuestion($laQuestion['Id_question']);
                                    $leVote = recupVoteQuestion($laQuestion['Id_question'],$_SESSION['utilisateur']['id']);
                                    if(isset($leVote) && !empty($leVote)){
                                        $leVote = $leVote[0]['Action_vote'];
                                        $couleurOn = "fas fa-heart like-on";
                                        $leVote = $leVote + 1;
                                    }else{
                                        $leVote = 1;
                                    }
                                    $adresse = 'affichage-question';
                                    ?>
                                        <button type="button" class="btn-like" href = "./traitement/like-fonction.php?vote=<?php echo $leVote?>&amp;id_question=<?php echo $laQuestion['Id_question']?>&amp;nbe=<?php echo $nombreVote[0]['COUNT(*)']?>">
                                            <i class="<?php 
                                                if($leVote === 1){
                                                    $couleurOn = "far fa-heart";
                                                }
                                                echo $couleurOn;
                                            ?>"></i>
                                        </button>
                                        <span><?php echo $nombreVote[0]['COUNT(*)']?></span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            }
        }
    }else{
        echo '1'; 
    }
}