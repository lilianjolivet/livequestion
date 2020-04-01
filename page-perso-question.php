<?php 
    require_once('./require/header.php');
    require_once('./require/nav.php');
    require_once('./db/req_sql.php');
    require_once('./traitement/traitement_formulaire.php');
    $questions = recupQuestion();
    $reponses = recupReponse();
    $profils = recupProfil();
    $categories = recupCateg();

    // traitement du formaulaire
    if (!empty($_POST)) {
		$traitement = traitementFormulaireReponse($_POST);
    }  

    // recuperation données de la question choisi
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $idQuestion = $_GET['id'];
        foreach($questions as $question){
            if($idQuestion == $question['Id_question']){
                $uniqueKey = $question['unique_key'];
                $dateQuestion = $question['Date_creation_question'];
                $titreQuestion = $question['Titre_question'];
                foreach($categories as $categorie){
                    if($question['#Id_categorie'] == $categorie['Id_categorie']){
                        $categ = $categorie['Libelle_categorie'];
                    }
                }
                foreach($profils as $profil){
                    if($question['#Id_profil'] == $profil['Id_profil']){ 
                        $pseudo =  $profil['Pseudo_profil'];
                    }
                }
                $nombreReponse = 0;
                foreach($reponses as $reponse){
                    if($uniqueKey == $reponse['#unique_key']){
                        $nombreReponse = $nombreReponse + 1;
                    }
                }
            }
        }
?>
        <div class="container">
            <div class="row">
                <div class="question">
                    <div class="info-question">
                        <div class="heading-question">
                            <p><a href=""><?php echo $pseudo ?></a></p>
                            <p><i class="far fa-clock"></i><?php echo $dateQuestion?></p>
                            <p><i class="far fa-comment-dots"></i><?php echo $nombreReponse ?></p>
                            <p><i class="fas fa-tag"></i><?php echo $categ?></p>
                        </div>
                        <div class="divider"></div>
                        <div class="bubble">
                            <div class="body-question">
                                <div class="title-question">
                                    <h2 class="text-break"><?php echo $titreQuestion?></h2>
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
        </div>

        <div class="container formulaire-reponse">
            <form action="#" method="POST" id="myForm">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="reponse">Ajouter une réponse</label>
                        <input type="text" class="form-control" id="reponse" name="reponse">
                    </div>
                    <span class="erreur col-md-12">
                        <?php
                            if (isset($traitement) && !$traitement['succes'] 
                                && isset($traitement['erreurs']['reponse'])) {
                                echo $traitement['erreurs']['reponse'];
                            }
                        ?>
                    </span>
                    <input type="hidden" name="id_fk_question" value="<?php echo $idQuestion?>"> 
                    <input type="hidden" name="date" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d')));?>">
                    <input type="hidden" name="fk_key" value="<?php echo $uniqueKey?>"> 
                </div>
                <button type="submit" class="btn">valider</button>
            </form>
        </div>
        <?php
            $refresh = 0;
            if(!empty($_POST['reponse'])&&
            (isset($_POST['id_fk_question']) && !empty($_POST['id_fk_question']))&&
            (isset($_POST['fk_key']) && !empty($_POST['fk_key']))){
                insertReponse($_POST);
                $refresh = 1;
            }
        ?>
            <div class="container">
            <?php foreach ($reponses as $reponse){ ?>
                <?php if (($reponse['#unique_key'] == $uniqueKey)){?>
                    <div class="row">
                        <div class="reponse">
                            <div class="info-reponse">
                                <div class="heading-reponse">
                                <?php foreach($profils as $profil){?>
                                    <?php if($reponse['#Id_profil'] == $profil['Id_profil']){ ?>
                                            <p><a href=""><?php echo $profil['Pseudo_profil']?></a></p>
                                    <?php }?>
                                <?php }?>
                                    <p><i class="far fa-clock"></i><?php echo $reponse['Date_reponse']?></p>
                                </div>
                                <div class="divider"></div>
                                <div class="bubble-reponse">
                                    <div class="body-reponse">
                                        <div class="title-reponse">
                                            <h2 class="text-break"><?php echo $reponse['Contenu_reponse']?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
            <?php }?>
        </div>
    <?php }?>
    <script>
        function reload($nbe){
            if($nbe == 1){
                document.location.href="page-perso-question.php?id=<?php echo $_GET['id']?>";
            } 
        }
    </script>
    <script>reload(<?php echo $refresh?>);</script>
    <?php require_once('./require/footer.php')?>