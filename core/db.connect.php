<?php

	require "config.php";
	
	try {
		$pdo = new PDO("mysql:host={$host}:{$port};dbname={$database};charset=utf8", $login, $password);
		$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		header("HTTP/1.1 400 Bad Request");
		echo "Database request failed." . "\n" . $e->getMessage();
		exit(1);
	}

?>