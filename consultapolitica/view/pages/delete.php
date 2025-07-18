<?php
include_once "../models/Produto.php";

$produto = null;
$mensagem = "";

// Buscar o produto pelo EAN
if (isset($_POST['ean'])) {
    $ean = trim($_POST['ean']);
    if (!empty($ean)) {
        $produto = Produto::buscarPorEan($ean);
        if (!$produto) {
            $mensagem = "Produto não encontrado para o EAN informado.";
        }
    } else {
        $mensagem = "Digite um EAN válido.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Excluir Produto</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?php include_once "../components/header.php"; ?>
    <section>
    <div class="container">
        <h1>Excluir Produto</h1>
        <form method="post" action="">
            <label for="ean">Digite o EAN do produto:</label>
            <input type="text" name="ean" id="ean" value="<?= htmlspecialchars($_POST['ean'] ?? '') ?>" required autofocus>
            <button type="submit">Buscar</button>
        </form>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>

        <?php if ($produto): ?>
            <div class="resultado">
                <h3>Detalhes do Produto</h3>
                <p><strong>EAN:</strong> <?= htmlspecialchars($produto['ean']) ?></p>
                <p><strong>Nome:</strong> <?= htmlspecialchars($produto['nome_produto']) ?></p>
                <p><strong>Fabricante:</strong> <?= htmlspecialchars($produto['fabricante']) ?></p>
                <p><strong>Código Interno:</strong> <?= htmlspecialchars($produto['codigo_interno']) ?></p>
                <p><strong>Política de Troca:</strong> <?= nl2br(htmlspecialchars($produto['politica_troca'])) ?></p>
            </div>
            <form method="post" action="/consultapolitica/controllers/ProdutoController.php" onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                <input type="hidden" name="acao" value="deletar">
                <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>"><br>
                <button type="submit" class="btn-delete">Excluir Produto</button>
            </form>
        <?php endif; ?>
    </div>
</section>
    <?php include_once "../components/footer.php"; ?>
</body>
</html>
