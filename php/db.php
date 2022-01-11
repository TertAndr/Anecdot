<?php
///$dsn = "mysql:host=localhost;port=3307;dbname=anecdotina;charset=utf8mb4";
///$pdo = new PDO($dsn,"root","");
$host = 'localhost';
$db   = 'anecdotina';
$port = '3307';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);

?>
