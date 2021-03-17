<?php
session_start();

// Infos pour se connecter à la BDD
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'ktr-msc-ls1';

// Connexion PDO
try {
	$connect = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo $e->getMessage();
}