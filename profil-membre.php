<?php 
    require_once('./require/header.php');
    require_once('./require/nav.php');
    require_once('./db/req_sql.php');
    require_once('./traitement/traitement_formulaire.php');
    $questions = recupQuestions();
    $categories = recupCategs();
    $reponses = recupReponses();
    $votes = recupVotes();

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $idProfil = $_GET['id'];
        $leProfil = recupLeProfil($idProfil);
    }
?>
<?php //affichage de l'ensemble des questions du profil selectionné?>
<section class="affichage-question">
    <div class="container">
        <h2 class="title-profil">
            <?php echo $leProfil[0]['Pseudo_profil'].', '.$leProfil[0]['Genre_profil'];?>
        </h2>
        <?php foreach($questions as $question){ ?>
            <?php if($question['#Id_profil'] === $idProfil){?>
                <div class="row">
                    <div class="question">
                        <div class="info-question">
                            <div class="heading-question">
                                <p><a href=""><?php echo $leProfil[0]['Pseudo_profil']?></a></p>
                                <p><i class="far fa-comment-dots"></i>
                                    <?php 
                                        $nombreReponse = 0;
                                        foreach($reponses as $reponse){
                                            if($question['unique_key'] === $reponse['#unique_key']){
                                                $nombreReponse = $nombreReponse + 1;
                                            }
                                        }
                                        echo $nombreReponse;
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
                            $nombreVote = 0;
                            $leVote = 0;
                            $couleurOn = " ";
                            if(isset($votes) && !empty($votes)){
                                foreach($votes as $vote){
                                    if($question['Id_question'] === $vote['#Id_question']){
                                        $nombreVote = $nombreVote + 1;
                                    }
                                    if($question['Id_question'] === $vote['#Id_question'] && $_SESSION['utilisateur']['id'] === $vote['#Id_profil']){
                                        $leVote = $vote['Action_vote'];
                                        $couleurOn = "fas fa-heart like-on";
                                    }
                                }
                                $leVote = $leVote + 1;
                            }else{
                                $leVote = 1;
                            }
                            $adresse = 'profil-membre';
                            ?>
                                <button type="button" class="btn-like" onclick="window.location.href = './like-fonction.php?vote=<?php echo $leVote?>&amp;id_question=<?php echo $question['Id_question']?>&amp;ad=<?php echo $adresse?>&amp;id_profil_question=<?php echo $idProfil?>';">
                                    <i class="<?php 
                                    if($leVote === 1){
                                        $couleurOn = "far fa-heart";
                                    }
                                    echo $couleurOn;
                                    ?>"></i>
                                </button>
                                <span><?php echo $nombreVote?></span>    
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        <?php }?>
    </div>
</section>
<?php require_once('./require/footer.php')?>