<?php
require 'config.php'; // Usa as credenciais do config.php

try {
    // Conexão sem especificar o banco de dados
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, $opcoes);
    
    // Criar banco de dados
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Banco de dados criado!<br>";

    // Conectar ao banco recém-criado
    $pdo->exec("USE $db");

    // Criar tabela de usuários
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario VARCHAR(255) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    
    // Criar tabela de jogos (com estrutura completa)
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS jogos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(255) NOT NULL,
            descricao TEXT,
            categoria VARCHAR(100) NOT NULL,
            preco DECIMAL(10,2),
            imagem VARCHAR(255) NOT NULL,
            data_adicao DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");

    echo "Tabelas criadas com sucesso!";
} catch (PDOException $e) {
    die("Erro crítico: " . htmlspecialchars($e->getMessage()));
}
?>