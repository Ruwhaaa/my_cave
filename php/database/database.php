<?php

function connexion(): ?PDO {
    $servername = 'localhost:3306';
    $username = 'root';
    $password = '';

    try{
        $conn = new PDO("mysql:host=$servername;dbname=mycave", $username, $password);
        $conn->exec('SET NAMES utf8');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return NULL;
    }
}