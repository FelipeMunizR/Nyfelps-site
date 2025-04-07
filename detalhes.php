<?php
$itens = [
    1 => ['titulo' => 'The Witcher 3', 'categoria' => 'RPG', 'descricao' => 'Jogo de RPG de ação.', 'imagem' => 'witcher3.jpg'],
    2 => ['titulo' => 'Minecraft', 'categoria' => 'Sandbox', 'descricao' => 'Jogo de construção em 3D.', 'imagem' => 'minecraft.jpg'],
    3 => ['titulo' => 'FIFA 21', 'categoria' => 'Esporte', 'descricao' => 'Jogo de futebol.', 'imagem' => 'fifa21.jpg'],
    4 => ['titulo' => 'League of Legends', 'categoria' => 'MOBA', 'descricao' => 'Jogo de arena de batalha online.', 'imagem' => 'lol.jpg'],
];

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = isset($itens[$id]) ? $itens[$id] : null;

if (!$item) {
    echo "Item não encontrado!";
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Jogo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Detalhes do Jogo</h1>

    <div class="detalhes">
        <img src="imagens/<?php echo $item['imagem']; ?>" alt="<?php echo $item['titulo']; ?>" />
        <h2><?php echo $item['titulo']; ?></h2>
        <p><strong>Categoria:</strong> <?php echo $item['categoria']; ?></p>
        <p><strong>Descrição:</strong> <?php echo $item['descricao']; ?></p>
    </div>

    <a href="index.php">Voltar ao Catálogo</a>

</body>
</html>
