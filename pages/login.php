<?php
session_start();
require 'config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$host = 'localhost';
$db = 'site_usuarios';
$user = 'root';
$pass = '';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $usuarioDB = $stmt->fetch();

        if ($usuarioDB && password_verify($senha, $usuarioDB['senha'])) {
            $_SESSION['usuario'] = $usuarioDB['usuario'];
            header('Location: index.php'); // Redireciona para a home
            exit;
        } else {
            $erro = 'Usuário ou senha inválidos.';
        }
    } catch (PDOException $e) {
        $erro = "Erro ao conectar: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../Css/login.css">
    <style>
        /* Mantenha seus estilos originais */
        body { font-family: Arial, sans-serif; padding: 40px; background: #f5f5f5; }
        .login-container { max-width: 400px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
        label, input { display: block; width: 100%; margin-bottom: 10px; }
        input[type="text"], input[type="password"] { padding: 8px; }
        button { padding: 10px; width: 100%; background: #333; color: white; border: none; border-radius: 4px; }
        p.erro { color: red; text-align: center; }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>

        <?php if ($erro): ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="usuario">Usuário:</label>
            <input type="text" name="usuario" id="usuario" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <button type="submit">Entrar</button>
        </form>

        <p><a href="cadastro.php">Ainda não tem conta? Cadastre-se</a></p>
    </div>
</body>
</html>
