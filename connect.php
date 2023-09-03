<?php
    $host = "127.0.0.1";
    $user = "root";
    $pass = "";
    $db = "ic_2023";
    $charset = "utf8mb4";

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset;";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try{
        $pdo = new PDO($dsn,$user,$pass);
    }catch(\PDOException $e){
        echo "Erroc Connect to Database msg: ". $e->getMessage();
    }

    session_start();



?>