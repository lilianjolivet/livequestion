<?php
    require_once('./require/header.php');
    require_once('./require/nav.php');
    require_once('./db/req_sql.php');
    require_once('./traitement/traitement_formulaire.php');

    if($_SESSION['utilisateur']['role'] != 2){
        header("Location: ./home.php");
    }
    $categories = recupCategs();

    // traitement du formaulaire 
?>
    <div class="container formulaire">
        <form action="" method="POST">
            <h2 class="pt-4">Gestion des catégories</h2>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="une_categorie">Insérer une nouvelle catégorie:</label>
                    <input type="text" class="form-control" id="une_categorie" name="une_categorie">
                    <span class="erreur">
                        <?php
                            if(!empty($_POST['une_categorie']) && rechercheCateg($_POST['une_categorie']) === True){
                                echo 'catégorie déjà existante';
                            }
                        ?>
                    </span>
                </div>
                <div class="form-group col-md-4">
                    <label for="categ[]">Supprimer des catégories:</label>
                    <select type="number" name="categ[]" class="selectpicker form-control" title="aucune options selectionné" id="categ[]" multiple>
                        <?php foreach($categories as $categorie){ ?>
                            <option value="<?php echo $categorie['Id_categorie'] ?>"><?php echo $categorie['Libelle_categorie'] ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group col-md-4 btn-form-categ">
                    <button type="submit" class="btn btn-categ">valider</button>
                </div>
            </div>
        </form>
        <?php
            if(!empty($_POST['categ'])){
               $categories = $_POST['categ'];
                foreach($categories as $categorie){
                    modifCategQuestion($categorie);
                    suppCategs($categorie); 
                }
            }
            if(!empty($_POST['une_categorie']) && rechercheCateg($_POST['une_categorie']) !== True){
                ajoutCateg($_POST['une_categorie']);
            }
        ?>
    </div>
<?php require_once('./require/footer.php')?>