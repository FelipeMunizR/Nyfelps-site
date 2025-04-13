<?php
// config.php

// 1. Configurações do Banco de Dados
$host = 'localhost';       // Servidor MySQL
$db   = 'site_usuarios';  // Nome do banco de dados
$user = 'root';           // Usuário do banco
$pass = '';               // Senha do banco
$charset = 'utf8mb4';     // Codificação ideal para suportar todos os caracteres

// 2. Opções de Conexão PDO
$opcoes = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lança exceções em erros
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna arrays associativos
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Desativa prepared statements emulados
];

// 3. Criação da Conexão PDO
try {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, $opcoes);
} catch (PDOException $e) {
    // Em produção, remova a mensagem de erro detalhada
    die("Falha na conexão: " . $e->getMessage());
}

?>