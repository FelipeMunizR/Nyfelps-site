<?php
session_start();
require 'config.php'; // Adicionado

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$erroCadastro = '';

// Adicionar novo jogo (Banco de Dados)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'adicionar') {
    $titulo = $_POST['titulo'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $descricao = $_POST['descricao'] ?? '';

    $imagem = $_FILES['imagem'] ?? null;

    if ($titulo && $categoria && $descricao && $imagem && $imagem['error'] === UPLOAD_ERR_OK) {
        try {
            // 1. Criar pasta de imagens (manual)
            $pastaUploads = '../imagens/'; // Criar esta pasta manualmente

            // 2. Gerar nome único
            $nomeUnico = uniqid('jogo_') . '_' . basename($imagem['name']);

            // 3. Mover arquivo
            if (move_uploaded_file($imagem['tmp_name'], $pastaUploads . $nomeUnico)) {

                $stmt = $pdo->prepare("INSERT INTO jogos (titulo, categoria, descricao, imagem) VALUES (?, ?, ?, ?)");
                $stmt->execute([$titulo, $categoria, $descricao, $nomeUnico]);
                header("Location: protegido.php"); // Recarrega para evitar reenvio
                exit;
            } else {
                $erroCadastro = "Erro ao salvar a imagem!";
            }
        } catch (PDOException $e) {
            $erroCadastro = "Erro ao cadastrar jogo: " . $e->getMessage();
        }
    } else {
        $erroCadastro = 'Preencha todos os campos corretamente!';
    }
}

// Remover jogo (Banco de Dados)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'remover') {
    $id = $_POST['id'] ?? '';
    if ($id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM jogos WHERE id = ?");
            $stmt->execute([$id]);
            header("Location: protegido.php"); // Recarrega para atualizar lista
            exit;
        } catch (PDOException $e) {
            $erroCadastro = "Erro ao remover jogo: " . $e->getMessage();
        }
    }
}

// Buscar jogos do banco
try {
    $jogos = $pdo->query("SELECT * FROM jogos")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao carregar jogos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<link rel="stylesheet" href="../Css/index.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<head>
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
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="acao" value="adicionar">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" required>

            <label for="categoria">Categoria:</label>
            <input type="text" name="categoria" id="categoria" required>

            <!-- Novo campo de descrição -->
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" rows="4" required></textarea>

            <label for="imagem">Selecione a imagem:</label>
            <input type="file" name="imagem" id="imagem" accept="image/*" required>

            <button type="submit">Adicionar Jogo</button>
        </form>

        <!-- Lista dos jogos cadastrados -->
        <h2>Jogos no Catálogo</h2>
        <?php if (!empty($jogos)): ?>
            <?php foreach ($jogos as $jogo): ?>
                <div class="jogo">
                    <strong><?php echo htmlspecialchars($jogo['titulo']); ?></strong><br>
                    Categoria: <?php echo htmlspecialchars($jogo['categoria']); ?><br>
                    <em>Descrição:</em> <?php echo htmlspecialchars($jogo['descricao']); ?><br>
                    <em>Imagem:</em> <?php echo htmlspecialchars($jogo['imagem']); ?><br>

                    <form method="POST" style="margin-top: 10px;">
                        <input type="hidden" name="acao" value="remover">
                        <input type="hidden" name="id" value="<?php echo $jogo['id']; ?>">
                        <button class="remover" type="submit">Remover</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum jogo cadastrado ainda.</p>
        <?php endif; ?>
    </div>
</body>

</html>