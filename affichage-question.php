<?php
    require_once('./db/req_sql.php');
    $profils = recupProfils();
    $categories = recupCategs();

    // pagination des questions
    $questionParPage = 30;
    $nombreQuestion = recupNombreQuestions();
    if(isset($_GET['page']) && !empty($_GET['page'])){
        $_GET['page'] = substr($_GET['page'],1,-1);
    }
    $pagesTotales = ceil($nombreQuestion[0]['COUNT(*)']/$questionParPage);
    if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $pagesTotales) {
        $_GET['page'] = intval($_GET['page']);
        $pageCourante = $_GET['page'];
    } else {
        $pageCourante = 1;
    }
    $depart = ($pageCourante-1)*$questionParPage;
    $questions = recupQuestionsLimite($depart,$questionParPage);
?> 
<section class="affichage-question">
    <div class="container">
        <?php 
            // affichage de l'ensemble des questions qui sont en 'all'
            foreach($questions as $question){ 
                if($question['Visible_question'] === 'all'){
                ?>
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
                <?php
                // accès aux questions privée des utilisateurs (visible pour vous si vous êtes autoriser)
                }else{
                    $amis = explode(':',$question['Visible_question']);
                    if(in_array($_SESSION['utilisateur']['id'],$amis) || $_SESSION['utilisateur']['id'] === $question['#Id_profil']){
                ?>
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
                                <div class="bubble bubble-friend">
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
                                            $couleurOn = "fas fa-heart like-on-friend";
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
                <?php
                    }
                }         
            }
       ?>
            <!-- système de navigation paginage -->
    <?php if($nombreQuestion[0]['COUNT(*)'] !== '0'){?>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="home.php?page='<?php echo $pageCourante - 1 ?>'" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <?php
                    for($i=1;$i<=$pagesTotales;$i++){
                        if($i === $pageCourante){
                ?>
                            <li class="page-item disabled"><a class="page-link link-already" href=""><?php echo $i ?></a></li>
                <?php
                        }else{
                ?>
                            <li class="page-item"><a class="page-link" href="home.php?page='<?php echo $i ?>'"><?php echo $i ?></a></li>
                <?php
                        }
                    }
                ?>
                <li class="page-item">
                    <a class="page-link" href="home.php?page='<?php echo $pageCourante + 1 ?>'" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
        <?php }?>
    </div>
</section>


