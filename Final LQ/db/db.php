<?php

    function connexionBdd() {
		$user = "root";
   		$pass = "root";
   		$dbName = "live_question";
   		return new \PDO("mysql:host=127.0.0.1;dbname=$dbName;charset=UTF8", $user, $pass);
	}
?>