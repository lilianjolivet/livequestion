<?php 
	// traitement formulaire pour ajout question
	function traitementFormulaireQuestion(array $informations) {
		$erreurs = [];
		
		if (empty($informations['question'])) {
			$erreurs['question'] = 'Veuillez saisir une question';
		}
		if (!empty($erreurs)) {
			return [
				'succes' => false,
				'erreurs' => $erreurs,
			];
		}
		return [
			'succes' => true,
		];
	}

	// traitement formulaire pour ajout question
	function traitementFormulaireReponse(array $informations) {
		$erreurs = [];
		
		if (empty($informations['reponse'])) {
			$erreurs['reponse'] = 'Veuillez saisir une reponse';
		}
		if (!empty($erreurs)) {
			return [
				'succes' => false,
				'erreurs' => $erreurs,
			];
		}
		return [
			'succes' => true,
		];
	}

	// traitement formulaire pour inscription
	function traitementFormulaireInscription(array $informations) {
		$erreurs = [];

		if (empty($informations['identifiant'])) {
			$erreurs['identifiant'] = 'Veuillez saisir un identifiant';
		}
		if (empty($informations['email'])) {
			$erreurs['email'] = 'Veuillez saisir un e-mail';
		}
		if (empty($informations['password'])) {
			$erreurs['password'] = 'Veuillez saisir un mot de passe';
		}
		if (empty($informations['password-verif'])) {
			$erreurs['password-verif'] = 'Veuillez confirmer le mot de passe';
		}
		if (empty($informations['sexe'] )) {
			$erreurs['sexe'] = 'Veuillez choisir une valeur';
		}
		if (!empty($erreurs)) {
			return [
				'succes' => false,
				'erreurs' => $erreurs,
			];
		}
		return [
			'succes' => true,
		];
	}

	// traitement formulaire pour connexion
	function traitementFormulaireConnexion(array $informations) {
		$erreurs = [];

		if (empty($informations['identifiant'])) {
			$erreurs['identifiant'] = 'Veuillez saisir un identifiant';
		}
		if (empty($informations['password'])) {
			$erreurs['password'] = 'Veuillez saisir un mot de passe';
		}
		if (!empty($erreurs)) {
			return [
				'succes' => false,
				'erreurs' => $erreurs,
			];
		}
		return [
			'succes' => true,
		];
	}

	// traitement formulaire pour modification données profil
	function traitementFormulaireProfil(array $informations) {
		$erreurs = [];

		if (empty($informations['identifiant']) && empty($informations['password']) && empty($informations['email']) && empty($informations['avatar'])) {
			$erreurs['message'] = 'Veuillez remplir au moins un champ';
		}
		if (!empty($erreurs)) {
			return [
				'succes' => false,
				'erreurs' => $erreurs,
			];
		}
		return [
			'succes' => true,
		];
	}

	// traitement formulaire pour ajouter un amis
	function traitementRequestFriend(array $informations) {
		$erreurs = [];
		
		if (empty($informations['userRequest'])) {
			$erreurs['userRequest'] = 'Veuillez remplir le champ';
		}
		if (!empty($erreurs)) {
			return [
				'succes' => false,
				'erreurs' => $erreurs,
			];
		}
		return [
			'succes' => true,
		];
	}

	// traitement formulaire pour ajouter une catégorie
	function traitementFormulaireCateg(array $informations) {
		$erreurs = [];
		
		if (empty($informations[''])) {
			$erreurs['une_categorie'] = 'Veuillez saisir une catégorie';
		}
		if (!empty($erreurs)) {
			return [
				'succes' => false,
				'erreurs' => $erreurs,
			];
		}
		return [
			'succes' => true,
		];
	}
?>