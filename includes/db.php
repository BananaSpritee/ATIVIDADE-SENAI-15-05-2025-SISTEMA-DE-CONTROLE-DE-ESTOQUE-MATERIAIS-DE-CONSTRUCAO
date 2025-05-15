<?php

$host = "localhost";
$db = "curso";
$user = "root";
$pass = "";

$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

$pdo->exec("CREATE DATABASE IF NOT EXISTS estoque_construcao");

$pdo->exec("CREATE TABLE IF NOT EXISTS categoria (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nome VARCHAR(100)
            );
            ");

$pdo->exec("CREATE TABLE IF NOT EXISTS produto (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nome VARCHAR(100),
            quantidade INT NOT NULL,
            valor INT NOT NULL,
            categoria_id INT NOT NULL,
            FOREIGN KEY (categoria_id) REFERENCES categoria(id)
            );
            ");

?>