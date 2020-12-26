<?php
/*
define("BASE_URL", "http://localhost:8090/meuamorpet/");
try {
	$pdo = new PDO("mysql:dbname=lojadez;localhost:8090", "root", "");
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}
}*/
session_start();
define("BASE_URL", "http://localhost/pet/adm/");
try {
	$pdo = new PDO("mysql:dbname=pet;localhost", "root", "");
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}
?>