<?php 
error_reporting(0);
error_reporting(E_ALL);
ob_start();

require_once 'func.php';

//db connection
$host = '';
$db   = '';
$user = '';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
];
$db = new PDO($dsn, $user, $pass, $opt);

$environment = "dev";

if($environment=="prod"){    
    $site_url = "your_production_url e.g https://prod.url";
}elseif($environment=="dev"){
    $site_url = "your_localhost_url";
}

 ?>
