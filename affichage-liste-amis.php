    <?php
     // traitement du formulaire
    if (!empty($_POST)) {
		$traitement = traitementRequestFriend($_POST);
    }
        $amisDemande = recupAmisDemande();
        $amisInvite = recupInviteAmis();
        $amis = recupAmis();
        $rechercheAmis = rechercheAmis();
     ?>
     <div class="section-friend">
         <?php if(!empty($amisInvite)){?>
        <div class="notification-friend">
            <p class="text-truncate"><?php echo count($amisInvite)?></p>
        </div>
         <?php }?>
        <div class="button-friend">
            <a href="#" data-toggle="modal" data-target="#modalFriend"><i class="fas fa-user-friends"></i></a>
        </div>
     </div>
     <div class="modal fade" id="modalFriend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <!-- recherche et demande d'ajout amis -->
                <form action="#" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" id="userRequest" name="userRequest" class="form-control" placeholder="Ajouter un amis" aria-label="Ajouter un amis" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-plus-circle"></i></button>
                        </div>
                    </div>
                    <span class="erreur col-md-12">
                        <?php
                        if (isset($traitement) && !$traitement['succes'] 
                            && isset($traitement['erreurs']['userRequest'])) {
                            echo $traitement['erreurs']['userRequest'];
                        }
                        ?>
                    </span>
                    <span class="erreur text-center">
                    <?php
                        // recherche d'un profil à ajouter en amis 
                        if(isset($_POST['userRequest']) && !empty($_POST['userRequest'])){
                           if($_SESSION['utilisateur']['pseudo'] !== $_POST['userRequest']){
                                $anwserSearch = False;
                                $searchProfil = rechercheProfil($_POST['userRequest']);
                                if($searchProfil === True){
                                    foreach($rechercheAmis as $rechercheAmi){
                                        if(($rechercheAmi['Profil_demande'] === $_SESSION['utilisateur']['pseudo'] 
                                        && $rechercheAmi['Profil_reception'] === $_POST['userRequest']) 
                                        || ($rechercheAmi['Profil_demande'] === $_POST['userRequest'] 
                                        && $rechercheAmi['Profil_reception'] === $_SESSION['utilisateur']['pseudo'])){
                                            $anwserSearch = True;
                                            echo 'Invitation en attente ou '.$_POST['userRequest'].' est déjà votre amis';
                                        }
                                    }
                                    if($anwserSearch === False){
                                        ajoutDemandeAmis($_POST['userRequest']);
                                    }
                                }else{
                                    echo 'Profil inexistant ou érroné';
                                }
                           }else{
                                echo 'Vous ne pouvez pas vous ajouter';
                           }
                        }
                    ?>
                    </span>
                </form>
                <!-- liste invitation amis -->
                <div class="modal-header modal-direction-content">
                    <h5 class="modal-title">Invitation d'amis:</h5>
                    <?php 
                    if(!empty($amisInvite)){
                        foreach($amisInvite as $amiInvite){
                                $profilInvite = recupProfilAmis($amiInvite['Profil_demande']);
                    ?>
                    <div class="list-invite">
                        <img src="./images/avatars/<?php echo $profilInvite[0]['avatar']?>" alt="" class="rounded avatar-option"> 
                        <p><a href=""><?php echo $amiInvite['Profil_demande']?></a></p>
                        <button type="button" class="close cross-btn" aria-label="Close" onclick="window.location.href ='./db/req_supp_sql.php?id_supp_invite=<?php echo $amiInvite['Id_amis']?>';">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <button type="button" class="check-btn" onclick="window.location.href = './db/req_sql.php?id_ami=<?php echo $amiInvite['Id_amis']?>';">
                            <span aria-hidden="true"><i class="fas fa-check"></i></span>
                        </button> 
                    </div>
                    <?php
                        } 
                    }else{
                        echo '<span class="font-italic text-muted">aucune invitation<span>';
                    }
                    ?>
                </div>
                <!-- liste d'amis -->
                <div class="modal-body modal-direction-content">
                    <h5 class="modal-title">Liste d'amis:</h5>
                    <?php
                    if(!empty($amis)){
                        foreach($amis as $ami){
                            if($_SESSION['utilisateur']['pseudo'] === $ami['Profil_demande']){
                                $profilAmi = recupProfilAmis($ami['Profil_reception']);
                            }elseif($_SESSION['utilisateur']['pseudo'] === $ami['Profil_reception']){
                                $profilAmi = recupProfilAmis($ami['Profil_demande']);
                            }
                    ?>
                    <div class="list-invite">
                        <img src="./images/avatars/<?php echo $profilAmi[0]['avatar']?>" alt="" class="rounded avatar-option"> 
                        <p><a href=""><?php echo $profilAmi[0]['Pseudo_profil']?></a></p>
                        <button type="button" class="close cross-btn" aria-label="Close" onclick="window.location.href = './db/req_supp_sql.php?id_supp_amitie=<?php echo $ami['Id_amis']?>&amp;id_supp_amis=<?php echo $profilAmi[0]['Id_profil']?>';">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </div>
                    <?php
                        }
                    }else{
                        echo '<span class="font-italic text-muted">aucun amis<span>';
                    }
                    ?>
                </div>
                <!-- demande en cours -->
                <div class="modal-footer modal-direction-content">
                    <h5 class="modal-title">Demande d'amis:</h5>
                    <?php 
                    if(!empty($amisDemande)){
                        foreach($amisDemande as $amiDemande){
                            $profilRecep = recupProfilAmis($amiDemande['Profil_reception']);
                    ?> 
                    <div class="list-invite">
                        <img src="./images/avatars/<?php echo $profilRecep[0]['avatar']?>" alt="" class="rounded avatar-option"> 
                        <p><a href=""><?php echo $amiDemande['Profil_reception']?></a></p>
                        <span class="font-italic text-muted">(en attente)</span>
                    </div>
                    <?php 
                        }
                    }else{
                        echo '<span class="font-italic text-muted">aucune demande<span>';
                    }
                    ?>
                </div>
            </div>
        </div>
     </div>