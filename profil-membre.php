<?php 
    require_once('./require/header.php');
    require_once('./require/nav.php');
    require_once('./db/req_sql.php');
    require_once('./traitement/traitement_formulaire.php');
    $categories = recupCategs();
    

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $idProfil = $_GET['id'];
        $leProfil = recupLeProfil($idProfil);
        $questions = recupQuestionsProfil($idProfil);
    }
?>
<?php //affichage de l'ensemble des questions du profil selectionné?>
<section class="affichage-question">
    <div class="container">
        <h2 class="title-profil">
            <img src="./images/avatars/<?php echo $leProfil[0]['avatar']?>" alt="<?php echo $leProfil[0]['avatar']?>" class="rounded avatar-option">
            <?php echo $leProfil[0]['Pseudo_profil'].', '.$leProfil[0]['Genre_profil'];?>
        </h2>
        <?php foreach($questions as $question){ ?>
            <?php if($question['Visible_question'] === 'all'){?>
                <div class="row">
                    <div class="question">
                        <div class="info-question">
                            <div class="heading-question">
                                <p><a href=""><?php echo $leProfil[0]['Pseudo_profil']?></a></p>
                                <p><i class="far fa-comment-dots"></i>
                                    <?php 
                                        $nombreReponse = calculeReponseQuestion($question['Id_question']);
                                        echo $nombreReponse[0]['COUNT(*)'];
                                    ?>
                                </p>
                                <?php $laCategorie = recupUneCateg($question['#Id_categorie']); ?>
                                <p><i class="fas fa-tag"></i><?php echo $laCategorie[0]['Libelle_categorie']?></p>
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
                            $leVote = recupVoteQuestion($question['Id_question'],$_SESSION['utilisateur']['id']);
                            if(isset($leVote) && !empty($leVote)){
                                $leVote = $leVote[0]['Action_vote'];
                                $couleurOn = "fas fa-heart like-on";
                                $leVote = $leVote + 1;
                            }else{
                                $leVote = 1;
                            }
                            ?>
                                <button type="button" class="btn-like" href = "./traitement/like-fonction.php?vote=<?php echo $leVote?>&amp;id_question=<?php echo $question['Id_question']?>&amp;nbe=<?php echo $nombreVote[0]['COUNT(*)']?>">
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
            <?php }else{
                    // affichage questions privée
                    $amis = explode(':',$question['Visible_question']);
                    if(in_array($_SESSION['utilisateur']['id'],$amis) || $_SESSION['utilisateur']['id'] === $question['#Id_profil']){
                ?>
                    <div class="row">
                        <div class="question">
                            <div class="info-question">
                                <div class="heading-question">
                                    <p><a href=""><?php echo $leProfil[0]['Pseudo_profil']?></a></p>
                                    <p><i class="far fa-comment-dots"></i>
                                        <?php 
                                            $nombreReponse = calculeReponseQuestion($question['Id_question']);
                                            echo $nombreReponse[0]['COUNT(*)'];
                                        ?>
                                    </p>
                                    <?php $laCategorie = recupUneCateg($question['#Id_categorie']); ?>
                                    <p><i class="fas fa-tag"></i><?php echo $laCategorie[0]['Libelle_categorie']?></p>
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
                                $leVote = recupVoteQuestion($question['Id_question'],$_SESSION['utilisateur']['id']);
                                if(isset($leVote) && !empty($leVote)){
                                    $leVote = $leVote[0]['Action_vote'];
                                    $couleurOn = "fas fa-heart like-on-friend";
                                    $leVote = $leVote + 1;
                                }else{
                                    $leVote = 1;
                                }
                                ?>
                                    <button type="button" class="btn-like" href = "./traitement/like-fonction.php?vote_private=<?php echo $leVote?>&amp;id_question=<?php echo $question['Id_question']?>&amp;nbe=<?php echo $nombreVote[0]['COUNT(*)']?>">
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
            <?php }?>
        <?php }?>
    </div>
</section>
<?php require_once('./require/footer.php')?>