<?php
//verificação de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

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
            header('Location: index.php');
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
</head>
<body>
    <h1>Login</h1>

    <?php if ($erro): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" id="usuario" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required><br><br>

        <button type="submit">Entrar</button>
    </form>

    <p><a href="cadastro.php">Ainda não tem conta? Cadastre-se</a></p>
</body>
</html>
