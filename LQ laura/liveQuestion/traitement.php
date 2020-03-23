<?php 

/**
* array $informations
*/
function traitementFormulaire(array $informations) {
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