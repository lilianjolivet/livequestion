<?php
    require_once('./db/req_sql.php');
    $questions = recupQuestion();
    $profils = recupProfil();
    $categories = recupCateg();
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
                                            <p><a href=""><?php echo $profil['Pseudo_profil']?></a></p>
                                    <?php }?>
                                <?php }?>
                            <p><?php echo $question['unique_key']?></p>
                            <p><i class="fas fa-tag"></i><?php echo $categories[$question['#Id_categorie']-1]['Libelle_categorie']?></p>
                        </div>
                        <div class="divider"></div>
                        <div class="bubble">
                            <div class="body-question">
                                <div class="title-question">
                                   <h2 class="text-break"><a href="page-perso-question.php?
                                   id=<?php echo $question['Id_question']?>&amp;
                                   pseudo=<?php foreach($profils as $profil){?>
                                            <?php if($question['#Id_profil'] == $profil['Id_profil']){ 
                                             echo $profil['Pseudo_profil'];
                                                    }?>
                                            <?php }?>&amp;
                                   categ=<?php echo $categories[$question['#Id_categorie']-1]['Libelle_categorie']?>&amp;
                                   unique_key=<?php echo $question['unique_key']?>&amp;
                                   date_question=<?php echo $question['Date_creation_question']?>&amp;
                                   question=<?php echo $question['Titre_question']?>">
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

