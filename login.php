<?php
session_start();

// Dados fixos de login
$usuarios = [
    'admin' => '$2y$10$wJERrQd6AqT4Wq.I1vynj9B6FQNYOtk0hx5k1czMZydsy.vBkN56O' // senha = "admin123"
];

$erro = '';

// Verificação do login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (isset($usuarios[$usuario]) && password_verify($senha, $usuarios[$usuario])) {
        $_SESSION['usuario'] = $usuario;
        header('Location: protegido.php');
        exit;
    } else {
        $erro = 'Usuário ou senha inválidos.';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <h1>Login</h1>

    <?php if ($erro): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" id="usuario" required>
        <br>
        <label for="senha">
