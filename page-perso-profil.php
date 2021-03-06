<?php
    require_once('./require/header.php');
    require_once('./require/nav.php');
    require_once('./db/req_sql.php');
    require_once('./traitement/traitement_formulaire.php');
    
    $profils = recupProfils();
    $leProfil = recupLeProfil($_SESSION['utilisateur']['id']);
    $avatar = $leProfil[0]['avatar'];

    // traitement du formaulaire
    if (!empty($_POST)) {
		$traitement = traitementFormulaireProfil($_POST);
    } 
?>
<?php
    //ajout d'une photo de profil
	if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
       $tailleMax = 2097152;
       $resolutionMax = [
           'width' => 200,
           'height' => 200,
       ];
       $resoImg = @getimagesize($_FILES['avatar']['tmp_name']);
	   $extensionsValides = ['jpg', 'jpeg', 'gif', 'png'];
	   if(($_FILES['avatar']['size'] <= $tailleMax)&&($resoImg[0] <= $resolutionMax['width'] && $resoImg[1] <= $resolutionMax['height'])) {
	      $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
	      if(in_array($extensionUpload, $extensionsValides)) {
	         $chemin = "./images/avatars/".$_SESSION['utilisateur']['id'].".".$extensionUpload;
	         $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
	         if($resultat) {
                 $infoAvatar = [
                    'avatar' => $_SESSION['utilisateur']['id'].".".$extensionUpload,
	                'id' => $_SESSION['utilisateur']['id'],
                 ];
                 modifProfil($infoAvatar);
	         } else {
	            $msg = "Erreur durant l'importation de votre photo de profil";
	         }
	      } else {
	         $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
	      }
	   } else {
	      $msg = "Votre photo de profil ne doit pas dépasser 2Mo et faire 200x200";
	   }
    }
    //formulaire permettant la modification des données utilisateur
?>
<div class="form-profil">
    <div class="container shadow p-3 mb-5 bg-white rounded">
        <img src="./images/avatars/<?php echo $avatar?>" class="rounded mx-auto d-block" alt="<?php echo $avatar?>">
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="form-group text-center">
                <label for="avatar">Votre avatar</label>
                <input type="file" class="form-control-file" id="avatar" name="avatar">
                <span class="erreur col-md-12">
                    <?php
                    $answer = 1;
                    if (isset($msg) && !empty($msg)) {
                        $answer = 0;
                        echo $msg;
                    }
                    ?>
                </span>
            </div>
            <div class="form-group text-center">
                <label for="identifiant">Votre identifiant</label>
                <input type="text" class="form-control" id="identifiant" name="identifiant">
            </div>
            <div class="form-group text-center">
                <label for="email">Votre adresse mail</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="form-group text-center">
                <label for="password">Votre mot de passe</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <span class="erreur col-md-12">
                <?php
                if (isset($traitement) && !$traitement['succes'] 
                    && isset($traitement['erreurs']['message'])) {
                    echo $traitement['erreurs']['message'];
                }
                ?>
			</span>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary ">valider</button>
            </div>
            <?php
                if(isset($_POST)&&!empty($_POST)){
                    if(isset($_POST['identifiant']) && !empty($_POST['identifiant'])){
                        foreach($profils as $profil){
                            if(($profil['Pseudo_profil'])===($_POST['identifiant'])){
                                echo '<span class="erreur">Identifiant déjà utiliser</span>';
                                $answer = 0;
                            }
                        }
                    }
                    if(isset($_POST['email']) && !empty($_POST['email'])){
                        foreach($profils as $profil){
                            if(($profil['Mail_profil'])===($_POST['email'])){
                                echo '<span class="erreur">email déjà utiliser</span>';
                                $answer = 0;
                            }
                        }
                    }
                    if(isset($_POST['password']) && !empty($_POST['password'])){
                        $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    }
                    if($answer == 1){
                        modifProfil($_POST);
                    } 
                }
            ?>
        </form>
    </div>
</div>
<?php require_once('./require/footer.php')?>

