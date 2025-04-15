<?php
session_start();
require 'config.php'; // Conexão com o banco

// Verificar se o ID foi passado corretamente
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

try {
    // Buscar detalhes do jogo
    $stmt = $pdo->prepare("SELECT * FROM jogos WHERE id = ?");
    $stmt->execute([$id]);
    $jogo = $stmt->fetch();

    if (!$jogo) {
        die("Jogo não encontrado!");
    }
} catch (PDOException $e) {
    die("Erro ao carregar detalhes: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($jogo['titulo']) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Css/detalhes.css">
   
</head>

<body>

    <h1>Detalhes do Jogo</h1>

    <div class="detalhes">
        <img src='../imagens/<?= htmlspecialchars($jogo['imagem']) ?>' alt="<?= htmlspecialchars($jogo['titulo']) ?>">
        <div class="texto">
            <h2><?= htmlspecialchars($jogo['titulo']) ?></h2>
            <p><strong>Categoria:</strong> <?= htmlspecialchars($jogo['categoria']) ?></p>
            <p><strong>Descrição:</strong> <?= htmlspecialchars($jogo['descricao']) ?></p>
            <?php if (!empty($jogo['preco'])): ?>
                <p><strong>Preço:</strong> R$ <?= number_format($jogo['preco'], 2, ',', '.') ?></p>
            <?php endif; ?>
        </div>
    </div>

    <button style="background-color: white;"><a href="../pages/index.php">Voltar ao Catálogo</a></button>


</body>

</html>