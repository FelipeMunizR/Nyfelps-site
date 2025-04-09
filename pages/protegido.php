<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// Inicializa o array de jogos, se não existir
if (!isset($_SESSION['itens'])) {
    $_SESSION['itens'] = [];
}

$erroCadastro = '';

// Processa o formulário para adicionar um novo jogo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'adicionar') {
    $titulo = $_POST['titulo'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $imagem = $_POST['imagem'] ?? '';

    if ($titulo && $categoria && $imagem) {
        $_SESSION['itens'][] = [
            'titulo' => $titulo,
            'categoria' => $categoria,
            'imagem' => $imagem
        ];
    } else {
        $erroCadastro = 'Todos os campos são obrigatórios!';
    }
}

// Processa o formulário para remover um jogo (pelo índice)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'remover') {
    $indice = $_POST['indice'] ?? '';
    if (is_numeric($indice) && isset($_SESSION['itens'][$indice])) {
        unset($_SESSION['itens'][$indice]);
        // Reorganiza o array para manter os índices corretos
        $_SESSION['itens'] = array_values($_SESSION['itens']);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área Protegida - Gerenciar Jogos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            text-align: center;
        }
        .logout {
            text-align: right;
        }
        form {
            margin-bottom: 20px;
        }
        label, input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type="text"] {
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            padding: 10px;
            width: 100%;
            background: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
        }
        .erro {
            color: red;
            text-align: center;
        }
        .jogo {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        .jogo img {
            max-width: 100%;
            height: auto;
        }
        .jogo form {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logout">
            <a href="logout.php">Sair</a>
        </div>
        <h1>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>
        <h2>Gerenciar Jogos</h2>

        <?php if ($erroCadastro): ?>
            <p class="erro"><?php echo $erroCadastro; ?></p>
        <?php endif; ?>

        <!-- Formulário para adicionar novo jogo -->
        <form method="POST">
            <input type="hidden" name="acao" value="adicionar">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" required>

            <label for="categoria">Categoria:</label>
            <input type="text" name="categoria" id="categoria" required>

            <label for="imagem">Imagem (nome do arquivo):</label>
            <input type="text" name="imagem" id="imagem" required>

            <button type="submit">Adicionar Jogo</button>
        </form>

        <!-- Lista dos jogos cadastrados -->
        <h2>Jogos no Catálogo</h2>
        <?php if (!empty($_SESSION['itens'])): ?>
            <?php foreach ($_SESSION['itens'] as $indice => $jogo): ?>
                <div class="jogo">
                    <strong><?php echo htmlspecialchars($jogo['titulo']); ?></strong><br>
                    Categoria: <?php echo htmlspecialchars($jogo['categoria']); ?><br>
                    <em>Imagem:</em> <?php echo htmlspecialchars($jogo['imagem']); ?><br>
                    <!-- Botão para remover o jogo -->
                    <form method="POST" style="margin-top: 10px;">
                        <input type="hidden" name="acao" value="remover">
                        <input type="hidden" name="indice" value="<?php echo $indice; ?>">
                        <button type="submit">Remover</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum jogo cadastrado ainda.</p>
        <?php endif; ?>
    </div>
</body>
</html>
