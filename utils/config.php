<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
function getPdo(){
/* Attempt to connect to MySQL database */
try{
    //host : localhost   dbname : test   username : root  password : ''
    $pdo = new PDO("mysql:host=localhost;dbname=test", 'root', '');
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
return $pdo;
}
?>