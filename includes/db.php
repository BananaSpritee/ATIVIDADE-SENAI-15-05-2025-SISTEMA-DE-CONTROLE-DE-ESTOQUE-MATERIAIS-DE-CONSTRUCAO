<?php

$host = "localhost";
$db = "estoque_construcao";
$user = "root";
$pass = "";

$conn = new PDO("mysql:host=$host", $user, $pass);

$conn->query("CREATE DATABASE IF NOT EXISTS estoque_construcao");

$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

$conn->query("CREATE TABLE IF NOT EXISTS categoria (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nome VARCHAR(100)
            );
            ");

$conn->query("CREATE TABLE IF NOT EXISTS produto (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nome VARCHAR(100) NOT NULL,
            quantidade INT NOT NULL,
            unidade VARCHAR(10) NOT NULL,
            valor DECIMAL(10,2) NOT NULL,
            categoria_id INT NOT NULL,
            FOREIGN KEY (categoria_id) REFERENCES categoria(id)
            );
            ");

// Verifica se já existem categorias cadastradas
$count = $conn->query("SELECT COUNT(*) FROM categoria")->fetchColumn();

if ($count == 0) {
    $stmt = $conn->prepare("INSERT INTO categoria (nome) VALUES (:nome)");

    $categorias = [
        'Elétrica',
        'Hidráulica',
        'Ferramentas',
        'Tintas',
        'Materiais Básicos',
        'Acabamentos',
        'Pisos e Revestimentos',
        'Madeiras'
    ];

    foreach ($categorias as $categoria) {
        $stmt->bindParam(':nome', $categoria);
        $stmt->execute();
    }
}

?>
