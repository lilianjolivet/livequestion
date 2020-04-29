<?php
    require_once('./db/req_sql.php');
    $questions = recupQuestions();
    $profils = recupProfils();
    $categories = recupCategs();

?>
<!-- affichage de l'ensemble des questions -->
<section class="affichage-question">
    <div class="container">
        <?php foreach($questions as $question){ ?>
            <div class="row">
                <div class="question">
                    <div class="info-question">
                        <div class="heading-question">
                        <?php foreach($profils as $profil){?>
                                    <?php if($question['#Id_profil'] === $profil['Id_profil']){ ?>
                                            <img src="./images/avatars/<?php echo $profil['avatar']?>" alt="<?php echo $profil['avatar']?>" class="rounded avatar-option"> 
                                            <p>
                                                <a href="profil-membre.php?
                                                    id=<?php echo $profil['Id_profil']?>">
                                                    <?php echo $profil['Pseudo_profil']?>
                                                </a>
                                            </p>
                                    <?php }?>
                                <?php }?>
                            <p><i class="far fa-comment-dots"></i>
                                <?php
                                    $nombreReponse = calculeReponseQuestion($question['Id_question']);
                                    echo $nombreReponse[0]['COUNT(*)'];
                                ?>
                            </p>
                            <p><i class="fas fa-tag"></i><?php echo $categories[$question['#Id_categorie']-1]['Libelle_categorie']?></p>
                        </div>
                        <div class="divider"></div>
                        <div class="bubble">
                            <div class="body-question">
                                <div class="title-question">
                                   <h2 class="text-break"><a href="page-perso-question.php?
                                   id=<?php echo $question['Id_question']?>">
                                   <?php echo $question['Titre_question']?></a></h2>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="footer-question">
                        <?php
                        // fonction like en liens avec la page like-fonction.php
                        $leVote = 0;
                        $couleurOn = " ";
                        $nombreVote = calculeVoteQuestion($question['Id_question']);
                        $lesVotes = recupVotesQuestion($question['Id_question']);
                        if(isset($lesVotes) && !empty($lesVotes)){
                            foreach($lesVotes as $vote){
                                if($question['Id_question'] === $vote['#Id_question'] && $_SESSION['utilisateur']['id'] === $vote['#Id_profil']){
                                    $leVote = $vote['Action_vote'];
                                    $couleurOn = "fas fa-heart like-on";
                                }
                            }
                            $leVote = $leVote + 1;
                        }else{
                            $leVote = 1;
                        }
                        $adresse = 'affichage-question';
                        ?>
                            <button type="button" class="btn-like" onclick="window.location.href = './traitement/like-fonction.php?vote=<?php echo $leVote?>&amp;id_question=<?php echo $question['Id_question']?>&amp;ad=<?php echo $adresse?>';">
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
        <?php }?>
    </div>
</section>


