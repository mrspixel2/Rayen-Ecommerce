<?php
	require 'config.php';
	
	$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

	try {
		$con = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>