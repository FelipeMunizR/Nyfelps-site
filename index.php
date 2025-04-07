<?php
$itens = [
    1 => ['titulo' => 'The Witcher 3', 'categoria' => 'RPG', 'imagem' => 'witcher3.jpg'],
    2 => ['titulo' => 'Minecraft', 'categoria' => 'Sandbox', 'imagem' => 'minecraft.jpg'],
    3 => ['titulo' => 'FIFA 21', 'categoria' => 'Esporte', 'imagem' => 'fifa21.jpg'],
    4 => ['titulo' => 'League of Legends', 'categoria' => 'MOBA', 'imagem' => 'lol.jpg'],
];

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

$categoriaFiltro = isset($_GET['categoria']) ? $_GET['categoria'] : '';

function filtrarItens($itens, $categoriaFiltro) {
    if ($categoriaFiltro) {
        return array_filter($itens, function($item) use ($categoriaFiltro) {
            return $item['categoria'] === $categoriaFiltro;
        });
    }
    return $itens;
}


$itensFiltrados = filtrarItens($itens, $categoriaFiltro);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Jogos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Catálogo de Jogos</h1>
    
    <form method="GET" action="index.php">
        <label for="categoria">Filtrar por Categoria:</label>
        <select name="categoria" id="categoria">
            <option value="">Selecione</option>
            <option value="RPG" <?php echo ($categoriaFiltro === 'RPG') ? 'selected' : ''; ?>>RPG</option>
            <option value="Sandbox" <?php echo ($categoriaFiltro === 'Sandbox') ? 'selected' : ''; ?>>Sandbox</option>
            <option value="Esporte" <?php echo ($categoriaFiltro === 'Esporte') ? 'selected' : ''; ?>>Esporte</option>
            <option value="MOBA" <?php echo ($categoriaFiltro === 'MOBA') ? 'selected' : ''; ?>>MOBA</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <div class="catalogo">
        <?php exibirItens($itensFiltrados); ?>
    </div>

</body>
</html>
