<?php
    require_once('./require/header.php');
    require_once('./require/nav.php');
    require_once('./db/req_sql.php');
    if($_SESSION['utilisateur']['role'] != 2){
        header("Location: ./home.php");
    }
?>
<?php require_once('./require/footer.php')?>