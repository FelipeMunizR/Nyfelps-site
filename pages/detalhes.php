<?php

$itens = [
    1 => [
        'titulo' => 'The Witcher 3', 
        'categoria' => 'RPG', 
        'imagem' => 'https://th.bing.com/th/id/OIP.-xmCbnhkm4xfHDGb9FudVgHaEK?w=304&h=180&c=7&r=0&o=5&pid=1.7',
        'descricao' => 'The Witcher 3 é um RPG de ação onde você joga como Geralt de Rivia em um mundo aberto repleto de monstros, magia e escolhas morais.'
    ],
    2 => [
        'titulo' => 'Minecraft', 
        'categoria' => 'Sandbox', 
        'imagem' => 'https://th.bing.com/th/id/OIP.4q8OzpUFH2-t8mFn4xV9bAAAAA?w=119&h=180&c=7&r=0&o=5&pid=1.7',
        'descricao' => 'Minecraft é um jogo de construção e exploração, onde você pode criar o que quiser no seu próprio mundo gerado aleatoriamente.'
    ],
    3 => [
        'titulo' => 'FIFA 21', 
        'categoria' => 'Esporte', 
        'imagem' => 'https://th.bing.com/th/id/OIP.56azeF_l4UbBW5q8qiQgJAHaD2?w=300&h=180&c=7&r=0&o=5&pid=1.7',
        'descricao' => 'FIFA 21 é um jogo de futebol que simula a experiência do esporte com gráficos realistas e jogabilidade fluida.'
    ],
    4 => [
        'titulo' => 'League of Legends', 
        'categoria' => 'MOBA', 
        'imagem' => 'https://th.bing.com/th/id/OIP.WlgL9lQyPe7XZKTYFedC0gHaEK?w=322&h=181&c=7&r=0&o=5&pid=1.7',
        'descricao' => 'League of Legends é um jogo de batalha entre equipes, onde jogadores controlam heróis com habilidades únicas para destruir a base inimiga.'
    ],
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
    <link rel="stylesheet" href="../Css/detalhes.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

    <h1>Detalhes do Jogo</h1>

    <div class="detalhes">
        <img src="<?php echo $item['imagem']; ?>" alt="<?php echo $item['titulo']; ?>" />
        <div class="texto">
            <h2><?php echo $item['titulo']; ?></h2>
            <strong>Categoria:</strong> <?php echo $item['categoria']; ?>
            <p><strong>Descrição:</strong> <?php echo $item['descricao']; ?></p>
        </div>
    </div>

    <div class="voltar">
    <button><a href="index.php">Voltar ao Catálogo</a></button>
    </div>

</body>
</html>
