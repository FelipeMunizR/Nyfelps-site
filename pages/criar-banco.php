<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$nomeBanco = 'site_usuarios';

try {
    $pdo = new PDO("mysql:host=$host", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar banco de dados
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $nomeBanco");
    echo "Banco de dados criado!<br>";

    // Conectar ao novo banco
    $pdo->exec("USE $nomeBanco");

    // Criar tabela de usuários
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario VARCHAR(50) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL
        )
    ");
    
    // Opcional: tabela de jogos para armazenar itens do catálogo
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS jogos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(100) NOT NULL,
            categoria VARCHAR(50) NOT NULL,
            imagem VARCHAR(100) NOT NULL
        )
    ");

    echo "Tabelas criadas com sucesso!";
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>
