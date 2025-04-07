<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$erroCadastro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $imagem = $_POST['imagem'] ?? '';

    if ($titulo && $categoria && $imagem) {
        // Salva o novo item na sessão
        $_SESSION['itens'][] = ['titulo' => $titulo, 'categoria' => $categoria, 'imagem' => $imagem];
    } else {
        $erroCadastro = 'Todos os campos são obrigatórios!';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Protegida</title>
</head>
<body>

    <h1>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h1>
    <p><a href="index.php">Voltar ao Catálogo</a></p>

    <h2>Cadastrar Novo Item</h2>
    <?php if ($erroCadastro): ?>
        <p style="color: red;"><?php echo $erroCadastro; ?></p>
    <?php endif; ?>

    <form method="POST" action="protegido.php">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required>
        <br>
        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" id="categoria" required>
        <br>
        <label for="imagem">Imagem (nome do arquivo):</label>
        <input type="text" name="imagem" id="imagem" required>
        <br>
        <button type="submit">Cadastrar</button>
    </form>

</body>
</html>
