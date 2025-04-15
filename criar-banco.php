<?php
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/trabalho/Nyfelps-site/');

// criar-banco.php
require 'pages/config.php'; // Carrega host, db, user, pass

try {
    // Conecta sem especificar o banco
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, $opcoes);
    
    // Cria o banco se não existir
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $db 
                CHARACTER SET utf8mb4 
                COLLATE utf8mb4_unicode_ci");
    echo "Banco '$db' criado! ✅<br>";

    // Conecta ao banco recém-criado
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, $opcoes);

    // Cria tabelas
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario VARCHAR(255) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB
    ");
    echo "Tabela 'usuarios' criada! ✅<br>";

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS jogos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(255) NOT NULL,
            descricao TEXT,
            categoria VARCHAR(100) NOT NULL,
            imagem VARCHAR(255) NOT NULL,
            data_adicao DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB
    ");
    echo "Tabela 'jogos' criada! ✅<br>";

    echo "✅ Setup completo! Acesse <a href='" . BASE_URL . "pages/index.php'>index.php</a>";

} catch (PDOException $e) {
    die("<strong>Erro:</strong> " . htmlspecialchars($e->getMessage()));
}
?>