<?php

$itens = [
    1 => ['titulo' => 'The Witcher 3', 'categoria' => 'RPG', 'imagem' => 'https://upload.wikimedia.org/wikipedia/commons/7/79/The_Witcher_3_cover_art.jpg'],
    2 => ['titulo' => 'Minecraft', 'categoria' => 'Sandbox', 'imagem' => 'https://upload.wikimedia.org/wikipedia/commons/a/a7/Minecraft_logo.svg'],
    3 => ['titulo' => 'FIFA 21', 'categoria' => 'Esporte', 'imagem' => 'https://upload.wikimedia.org/wikipedia/commons/4/43/FIFA_21_cover_art.jpg'],
    4 => ['titulo' => 'League of Legends', 'categoria' => 'MOBA', 'imagem' => 'https://upload.wikimedia.org/wikipedia/commons/7/7c/League_of_Legends_logo.svg'],
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
    <link rel="stylesheet" href="../Css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

    <header class="header">
    <h1>Catálogo de Jogos</h1>
</header>



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
