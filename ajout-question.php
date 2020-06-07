<?php 
    require_once('./require/header.php');
    require_once('./require/nav.php');
    require_once('./db/req_sql.php');
    require_once('./traitement/traitement_formulaire.php');

    $categories = recupCategs();
    $amis = recupAmis();

    // traitement du formaulaire
    if (!empty($_POST)) {
		$traitement = traitementFormulaireQuestion($_POST);
    }  
?>
<div class="container formulaire">
    <form action="#" method="POST">
        <h2 class="pt-4">Posez une question</h2>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="question">Quelle est votre question ?</label>
                <input type="text" class="form-control" id="question" name="question">
            </div>
            <span class="erreur col-md-12">
                <?php
                if (isset($traitement) && !$traitement['succes'] 
                    && isset($traitement['erreurs']['question'])) {
                    echo $traitement['erreurs']['question'];
                }
                if(isset($_POST['question']) && !empty($_POST['question']) && strlen($_POST['question'])> 255){
                    echo 'votre question est trop longue (maximum 255 caractères)';
                }
                ?>
			</span>
            <div class="form-group col-md-4">
            <label for="inputCateg">catégorie</label>
                <select type="number" id="inputCateg" class="form-control" name="inputCateg">
                    <?php foreach($categories as $categorie) {?>
                        <option value="<?php echo $categorie['Id_categorie']?>"><?php echo $categorie['Libelle_categorie']; ?></option>
                    <?php }?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="friend[]">Qui pourra voir votre question ?</label>
                <select type="number" name="friend[]" class="selectpicker form-control" title="aucune options selectionné" id="friend[]" multiple>
                    <?php
                        if(!empty($amis)){
                            foreach($amis as $ami){
                                if($_SESSION['utilisateur']['pseudo'] === $ami['Profil_demande']){
                                    $profilAmi = recupProfilAmis($ami['Profil_reception']);
                                }elseif($_SESSION['utilisateur']['pseudo'] === $ami['Profil_reception']){
                                    $profilAmi = recupProfilAmis($ami['Profil_demande']);
                                }
                                ?>
                                <option value="<?php echo $profilAmi[0]['Id_profil'] ?>"><?php echo $profilAmi[0]['Pseudo_profil'] ?></option>
                                <?php
                            }
                        }
                    ?>
                </select>
            </div>
            <input type="hidden" name="date" value="
                <?php
                date_default_timezone_set('Europe/Paris');
                $dateTime = new DateTime();
                echo $dateTime->format('Y-m-d H:i:s');
                ?>
            "> 
            <input type="hidden" name="id_key" value="<?php echo uniqid();?>"> 
        </div>    
        <button type="submit" class="btn">valider</button>
    </form>
</div>
<?php 
$refresh = 0;
if(!empty($_POST['question']) && strlen($_POST['question'])<= 255){
    if(empty($_POST['friend'])){
        $_POST['friend'] = 'all';
    }else{
        $_POST['friend'] = implode(":",$_POST['friend']);
    }
    insertQuestion($_POST);
    $refresh = 1;  
}
?>
<script>
    function reload($nbe){
        if($nbe === 1){
            document.location.href="./home.php";
        } 
    }
</script>
<script>reload(<?php echo $refresh?>);</script>
<?php require_once('./require/footer.php')?>