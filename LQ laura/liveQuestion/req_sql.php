<?php 

require_once('./db.php');

function recupererProfil() {
	$connexion = connexionBdd();

   	$requete = $connexion->prepare("SELECT * FROM profil");
   	$requete->execute();

   	$profils = $requete->fetchAll(\PDO::FETCH_ASSOC);

   	return $profils;
}

function ajoutProfil(array $info) {
	$connexion = connexionBdd();

	$requete = $connexion->prepare('INSERT INTO `profil`(`Pseudo_profil`, `Mail_profil`, `MotDePasse_profil`, `Genre_profil`, `#Id_role`) VALUES (:Pseudo_profil, :Mail_profil, :MotDePasse_profil, :Genre_profil, :Fk_Id_role)');
    $requete->bindParam(':Pseudo_profil', $Pseudo);
    $requete->bindParam(':Mail_profil', $Mail);
	$requete->bindParam(':MotDePasse_profil', $MotDePasse);
	$requete->bindParam(':Genre_profil', $Genre);
	$requete->bindParam(':Fk_Id_role', $Fk_role);
    $Pseudo = $info['identifiant'];
    $Mail = $info['email'];
	$MotDePasse = $info['password'];
	$Genre = $info['sexe'];
	$Fk_role = 1;
    $requete->execute();
}

?>