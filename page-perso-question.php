<?php 
    require_once('./require/header.php');
    require_once('./require/nav.php');
    require_once('./db/req_sql.php');
    require_once('./traitement/traitement_formulaire.php');
    $reponses = recupReponses();
    $profils = recupProfils();

    // traitement du formaulaire
    if (!empty($_POST)) {
		$traitement = traitementFormulaireReponse($_POST);
    }  

    // recuperation données de la question choisi
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $idQuestion = $_GET['id'];

        $laQuestion = recupLaQuestion($idQuestion);
        $leProfil = recupLeProfil($laQuestion['#Id_profil']);

        if($laQuestion['Visible_question'] !== 'all'){
            $amis = explode(':',$laQuestion['Visible_question']);
            if(in_array($_SESSION['utilisateur']['id'],$amis) !== true && $_SESSION['utilisateur']['id'] !== $laQuestion['#Id_profil']){
                header('Location: ./home.php');
            }
        }
        $nombreReponse = calculeReponseQuestion($laQuestion['Id_question']);

        $titreQuestion = $laQuestion['Titre_question'];
        $uniqueKey = $laQuestion['unique_key'];
        $dateQuestion = $laQuestion['Date_creation_question'];
        $titreQuestion = $laQuestion['Titre_question'];

        $pseudo = $leProfil[0]['Pseudo_profil'];
        $idProfil = $leProfil[0]['Id_profil'];
        $avatar = $leProfil[0]['avatar'];
        
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
?>
        <?php //affichage de la question selectionné ?>
        <div class="container">
            <div class="row">
                <div class="question">
                    <div class="info-question">
                        <div class="heading-question">
                            <img src="./images/avatars/<?php echo $avatar?>" alt="<?php echo $avatar?>" class="rounded avatar-option">
                            <p><a href="profil-membre.php?
                            id=<?php echo $idProfil?>">
                            <?php echo $pseudo ?></a></p>
                            <p><i class="far fa-clock"></i><?php echo $dateQuestion?></p>
                            <p><i class="far fa-comment-dots"></i><?php echo $nombreReponse[0]['COUNT(*)']?></p>
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
                        
                            <button type="button" class="btn-like" href = "./traitement/like-fonction.php?vote=<?php echo $leVote?>&amp;id_question=<?php echo $idQuestion?>&amp;nbe=<?php echo $nombreVote[0]['COUNT(*)']?>">
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
        <?php //ajout d'une réponse à la question selectionné ?>
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
                    <input type="hidden" name="date" value="
                        <?php 
                            date_default_timezone_set('Europe/Paris');
                            $dateTime = new DateTime();
                            echo $dateTime->format('Y-m-d H:i:s');
                        ?>
                    ">
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
            <?php // affichage de l'ensemble des réponses de la question selectionné
                foreach ($reponses as $reponse){ ?>
                <?php if (($reponse['#unique_key'] === $uniqueKey)){?>
                    <div class="row">
                        <div class="reponse">
                            <div class="info-reponse">
                                <div class="heading-reponse">
                                <?php foreach($profils as $profil){?>
                                    <?php if($reponse['#Id_profil'] === $profil['Id_profil']){ ?>
                                            <img src="./images/avatars/<?php echo $profil['avatar']?>" alt="<?php echo $profil['avatar']?>" class="rounded avatar-option">
                                            <p><a href="profil-membre.php?
                                            id=<?php echo $profil['Id_profil']?>"><?php echo $profil['Pseudo_profil']?></a></p>
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
    <?php }else{
        header('Location: ./home.php');
    }?>
    <script>
        //fonction effet rafraichissement page (redirection vers la page actuelle)
        function reload($nbe){
            if($nbe === 1){
                document.location.href="page-perso-question.php?id=<?php echo $_GET['id']?>";
            } 
        }
    </script>
    <script>reload(<?php echo $refresh?>);</script>
    <?php require_once('./require/footer.php')?>
