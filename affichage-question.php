<?php
    require_once('./db/req_sql.php');
    $questions = recupQuestion();
    $profils = recupProfil();
    $categories = recupCateg();
    $reponses = recupReponse();
?>

<section class="affichage-question">
    <div class="container">
        <?php foreach($questions as $question){ ?>
            <div class="row">
                <div class="question">
                    <div class="info-question">
                        <div class="heading-question">
                        <?php foreach($profils as $profil){?>
                                    <?php if($question['#Id_profil'] == $profil['Id_profil']){ ?>
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
                                    $nombreReponse = 0;
                                    foreach($reponses as $reponse){
                                        if($question['unique_key'] == $reponse['#unique_key']){
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
                            <i class="far fa-heart"></i><span>compteur like</span>       
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</section>

