<?php
session_start();
require 'config.php'; // Conexão com o banco

// Verifica configuração do banco de dados
try {
    $pdo->query("SELECT 1 FROM usuarios LIMIT 1");
} catch (PDOException $e) {
    die("Banco não configurado. Acesse <a href='../criar-banco.php'>criar-banco.php</a> primeiro.");
}

try {
    // Buscar categorias para o filtro
    $categorias = $pdo->query("SELECT DISTINCT categoria FROM jogos ORDER BY categoria")->fetchAll(PDO::FETCH_COLUMN);
    
    // Filtrar por categoria (se selecionada)
    $categoriaFiltro = isset($_GET['categoria']) ? $_GET['categoria'] : '';
    $where = $categoriaFiltro ? "WHERE categoria = :categoria" : "";
    
    // Consulta principal
    $sql = "SELECT * FROM jogos $where";
    $stmt = $pdo->prepare($sql);
    
    if($categoriaFiltro) {
        $stmt->bindParam(':categoria', $categoriaFiltro, PDO::PARAM_STR);
    }
    
    $stmt->execute();
    $jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro ao carregar jogos: " . $e->getMessage());
}
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

    <header>
        <div class="links">
            <a href="index.php">Home</a>
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="protegido.php">Gerenciar Jogos</a>
                <a href="logout.php">Sair</a>
            <?php else: ?>
                <a href="login.php">Entrar</a>
                <a href="cadastro.php">Cadastrar</a>
            <?php endif; ?>
        </div>
    </header>

    <main>
        <h1 style="text-align: center;">Catálogo de Jogos</h1>

        <!-- Filtro de Categorias -->
        <form method="GET" action="index.php" style="text-align: center; margin-bottom: 20px;">
            <label for="categoria">Filtrar por Categoria:</label>
            <select name="categoria" id="categoria">
                <option value="">Todas</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= htmlspecialchars($cat) ?>" 
                        <?= ($categoriaFiltro === $cat) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button class="filtrar" type="submit">Filtrar</button>
        </form>

        <!-- Listagem de Jogos -->
        <div class="catalogo">
            <?php foreach ($jogos as $jogo): ?>
                <div class='item'>
                    <img src='../imagens/<?= htmlspecialchars($jogo['imagem']) ?>' alt='<?= htmlspecialchars($jogo['titulo']) ?>'>
                    <h3><?= htmlspecialchars($jogo['titulo']) ?></h3>
                    <p>Categoria: <?= htmlspecialchars($jogo['categoria']) ?></p>
                    <a class="seemore" href='detalhes.php?id=<?= $jogo['id'] ?>'>Ver mais</a>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (isset($_SESSION['usuario'])): ?>
            <div class="gerenciar">
                <h2>Gerencie o Catálogo</h2>
                <a href="protegido.php">Acessar Gerenciamento</a>
            </div>
        <?php endif; ?>
    </main>

</body>
</html>