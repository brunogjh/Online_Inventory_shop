<?php

// switch to RDS before pushing, when testing can use localhost

// RDS;
$dbhost = $_SERVER['RDS_HOSTNAME'];
$dbport = $_SERVER['RDS_PORT'];
$dbname = $_SERVER['RDS_DB_NAME'];
$username = $_SERVER['RDS_USERNAME'];
$password = $_SERVER['RDS_PASSWORD'];

// // localhost
// $dbhost = "localhost";
// $dbport = 3306;
// $dbname = "onlineshop";
// $username = "root";
// $password = "";

$charset = 'utf8' ;

$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";


$pdo = new PDO($dsn, $username, $password);
// Create connection

$con = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);
// $con = mysqli_connect($dbhost, $username, $password, $dbname, $dbport);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
