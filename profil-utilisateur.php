<?php 
    require_once('./require/header.php');
    require_once('./require/nav.php');
    require_once('./db/req_sql.php');
    require_once('./traitement/traitement_formulaire.php');
    $profils = recupProfil();
    $questions = recupQuestion();
    $categories = recupCateg();
    $reponses = recupReponse();

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $idProfil = $_GET['id'];
    }
?>
<section class="affichage-question">
    <div class="container">
        <h2 class="title-profil">
            <?php 
                foreach($profils as $profil){
                    if($idProfil == $profil['Id_profil']){ 
                        echo $profil['Pseudo_profil'].', '.$profil['Genre_profil'];
                    }
                }
            ?>
        </h2>
        <?php foreach($questions as $question){ ?>
            <?php if($question['#Id_profil'] == $idProfil){?>
                <div class="row">
                    <div class="question">
                        <div class="info-question">
                            <div class="heading-question">
                            <?php foreach($profils as $profil){?>
                                        <?php if($idProfil == $profil['Id_profil']){ ?>
                                                <p><a href=""><?php echo $profil['Pseudo_profil']?></a></p>
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
        <?php }?>
    </div>
</section>