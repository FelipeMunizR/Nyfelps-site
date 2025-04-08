<?php

$itens = [
    1 => ['titulo' => 'The Witcher 3', 'categoria' => 'RPG', 'imagem' => 'https://th.bing.com/th/id/OIP.-xmCbnhkm4xfHDGb9FudVgHaEK?w=304&h=180&c=7&r=0&o=5&pid=1.7'],
    2 => ['titulo' => 'Minecraft', 'categoria' => 'Sandbox', 'imagem' => 'https://th.bing.com/th/id/OIP.4q8OzpUFH2-t8mFn4xV9bAAAAA?w=119&h=180&c=7&r=0&o=5&pid=1.7'],
    3 => ['titulo' => 'FIFA 21', 'categoria' => 'Esporte', 'imagem' => 'https://th.bing.com/th/id/OIP.56azeF_l4UbBW5q8qiQgJAHaD2?w=300&h=180&c=7&r=0&o=5&pid=1.7'],
    4 => ['titulo' => 'League of Legends', 'categoria' => 'MOBA', 'imagem' => 'https://th.bing.com/th/id/OIP.WlgL9lQyPe7XZKTYFedC0gHaEK?w=322&h=181&c=7&r=0&o=5&pid=1.7'],
];


function exibirItens($itens) {
    foreach ($itens as $id => $item) {
        echo "<div class='item'>
                <img src='{$item['imagem']}' alt='{$item['titulo']}' />
                <h3>{$item['titulo']}</h3>
                <p>Categoria: {$item['categoria']}</p>
                <a href='detalhes.php?id={$id}'>Ver mais</a>
                <button onclick='removerJogo({$id})'>Remover</button>
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

if (isset($_POST['adicionar'])) {
    $novoJogo = [
        'titulo' => $_POST['titulo'],
        'categoria' => $_POST['categoria'],
        'imagem' => $_POST['imagem']
    ];
    $itens[] = $novoJogo;
}

if (isset($_GET['remover'])) {
    $idRemover = $_GET['remover'];
    unset($itens[$idRemover]);
}

// Filtrar os itens com base na categoria
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
    <button type="button" onclick="mostrarFormulario()">Adicionar Jogo</button>
</form>

<div id="formAdicionarJogo" style="display:none;">
    <h2 class="gameadd">Adicionar Novo Jogo</h2>
    <form method="POST" action="index.php" class="add">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required><br>
        
        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" required><br>
        
        <label for="imagem">URL da Imagem:</label>
        <input type="text" name="imagem" required><br>

        <button type="submit" name="adicionar">Adicionar Jogo</button>
    </form>
</div>

<div class="catalogo">
    <?php exibirItens($itensFiltrados); ?>
</div>

<script>
    function mostrarFormulario() {
        var form = document.getElementById("formAdicionarJogo");
        form.style.display = form.style.display === "none" ? "block" : "none";
    }

    function removerJogo(id) {
        if (confirm("Tem certeza de que deseja remover este jogo?")) {
            window.location.href = "index.php?remover=" + id;
        }
    }
</script>

</body>
</html>
