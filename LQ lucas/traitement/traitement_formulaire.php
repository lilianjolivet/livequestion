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
?>