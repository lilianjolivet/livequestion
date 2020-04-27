<?php
    require_once('./require/header.php');
    require_once('./require/nav.php');
    require_once('./db/req_sql.php');
    if($_SESSION['utilisateur']['role'] != 2){
        header("Location: ./home.php");
    }
    $questions = recupQuestions();
    $profils = recupProfil();
?>
<?php // affichage de l'ensemble des questions des profils
    if(isset($questions) && !empty($questions) && isset($profils) && !empty($profils)){?>
    <table class="table table-striped">
        <thead>
            <tr class="admin">
            <th scope="col">Question</th>
            <th scope="col">Date de publication</th>
            <th scope="col">Auteur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($questions as $question){?>
                <tr>
                <td><?php echo $question['Titre_question']?></td>
                <td><?php echo $question['Date_creation_question']?></td>
                <td>
                    <?php
                        foreach($profils as $profil){
                            if($question['#Id_profil'] === $profil['Id_profil']){
                                echo $profil['Pseudo_profil'];
                            }
                        }
                    ?>
                </td>
                <td>
                    <button type="button" class="close cross-btn" aria-label="Close" onclick="window.location.href = './db/req_supp_sql.php?id_supp_question=<?php echo $question['Id_question']?>';">
                        <span aria-hidden="true">&times;</span>
                    </button> 
                </td>
                </tr>
            <?php }?>
        </tbody>
    </table>
<?php }?>
<?php require_once('./require/footer.php')?>