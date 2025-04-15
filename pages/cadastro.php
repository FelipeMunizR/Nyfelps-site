<?php
session_start();
require 'config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($usuario && $senha) {
        try {

            // Verificar se o usuário já existe
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = ?");
            $stmt->execute([$usuario]);

            if ($stmt->fetch()) {
                $mensagem = "Nome de usuário já cadastrado.";
            } else {
                // Inserir o usuário no banco
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, senha) VALUES (?, ?)");
                $stmt->execute([$usuario, $senhaHash]);
                $mensagem = "Cadastro realizado com sucesso!";
            }
        } catch (PDOException $e) {
            $mensagem = "Erro: " . $e->getMessage();
        }
    } else {
        $mensagem = "Preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../Css/login.css">

</head>
<body>
    <div class="login-container">
    <div class="../Css/login.css">
        <h1>Cadastro</h1>

        <?php if ($mensagem): ?>
            <p class="mensagem"><?php echo $mensagem; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="usuario">Usuário:</label>
            <input type="text" name="usuario" id="usuario" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <button type="submit">Cadastrar</button>
        </form>

        <p><a href="login.php">Já tem conta? Faça login</a></p>
    </div>
    </div>
</body>
</html>
