<?php
$itens = [
    1 => ['titulo' => 'The Witcher 3', 'categoria' => 'RPG', 'imagem' => 'witcher3.jpg'],
    2 => ['titulo' => 'Minecraft', 'categoria' => 'Sandbox', 'imagem' => 'minecraft.jpg'],
    3 => ['titulo' => 'FIFA 21', 'categoria' => 'Esporte', 'imagem' => 'fifa21.jpg'],
    4 => ['titulo' => 'League of Legends', 'categoria' => 'MOBA', 'imagem' => 'lol.jpg'],
];

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

$itensFiltrados = array_filter($itens, function($item) use ($categoria) {
    return !$categoria || $item['categoria'] === $categoria;
});

function exibirItens($itens) {
    foreach ($itens as $id => $item) {
        echo "<div class='item'>
                <img src='imagens/{$item['imagem']}' alt='{$item['titulo']}' />
                <h3>{$item['titulo']}</h3>
                <p>Categoria: {$item['categoria']}</p>
                <a href='detalhes.php?id={$id}'>Ver mais</a>
              </div>";
}
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar Jogos</title>
</head>
<body>

    <h1>Filtrar Jogos por Categoria</h1>

    <form method="GET" action="filtrar.php">
        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria">
            <option value="">Selecione</option>
            <option value="RPG">RPG</option>
            <option value="Sandbox">Sandbox</option>
            <option value="Esporte">Esporte</option>
            <option value="MOBA">MOBA</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <div class="catalogo">
        <?php exibirItens($itensFiltrados); ?>
    </div>

</body>
</html>
