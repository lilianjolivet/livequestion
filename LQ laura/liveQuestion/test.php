<?php 
session_start();
if(isset($_SESSION['utilisateur']) && !empty($_SESSION['utilisateur'])){
     echo $_SESSION['utilisateur']['pseudo'].' '.$_SESSION['utilisateur']['id']; 
}


?>
