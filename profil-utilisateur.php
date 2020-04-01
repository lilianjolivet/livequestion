<?php 
    require_once('./require/header.php');
    require_once('./require/nav.php');
    require_once('./db/req_sql.php');
    require_once('./traitement/traitement_formulaire.php');
    $profils = recupProfil();
    $questions = recupQuestion();
    $categories = recupCateg();
?>
