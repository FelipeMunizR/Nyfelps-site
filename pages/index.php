<?php
session_start();

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
    <style>
        /* CSS básico pra exemplo */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .topo {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topo .titulo {
            font-size: 20px;
            font-weight: bold;
        }

        .topo .links a {
            color: white;
            margin-left: 15px;
            text-decoration: none;
        }

        .topo .links a:hover {
            text-decoration: underline;
        }

        .catalogo {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .item {
            border: 1px solid #ccc;
            padding: 10px;
            width: 200px;
        }

        .item img {
            width: 100%;
            height: auto;
        }

        .gerenciar {
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            background: #e7e7e7;
        }

        .gerenciar a {
            display: inline-block;
            margin-top: 10px;
            background: #333;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <div class="topo">
        <div class="titulo">Catálogo de Jogos</div>
        <div class="links">
            <a href="index.php">Home</a>
            <a href="catalogo.php">Catálogo</a>
            <a href="sobre.php">Sobre</a>
            <a href="contato.php">Contato</a>
            <?php if (isset($_SESSION['usuario'])): ?>
                <!-- Exibe as opções para usuários logados -->
                <a href="protegido.php">Gerenciar Jogos</a>
                <a href="logout.php">Sair</a>
            <?php else: ?>
                <a href="login.php">Entrar</a>
                <a href="cadastro.php">Cadastrar</a>
            <?php endif; ?>
        </div>
    </div>

    <main>
        <h1 style="text-align: center;">Catálogo de Jogos</h1>

        <form method="GET" action="index.php" style="text-align: center; margin-bottom: 20px;">
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

        <?php if (isset($_SESSION['usuario'])): ?>
            <div class="gerenciar">
                <h2>Gerencie o Catálogo</h2>
                <p>Adicione ou remova jogos do catálogo.</p>
                <a href="protegido.php">Acessar Gerenciamento</a>
            </div>
        <?php endif; ?>
    </main>

</body>
</html>
