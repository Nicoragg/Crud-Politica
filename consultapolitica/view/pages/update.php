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
    <title>Atualizar Produto</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?php include_once "../components/header.php"; ?>
    <section>
    <div class="container">
        <h1>Atualizar Produto</h1>
        <form method="post" action="">
            <label for="ean">Digite o EAN do produto:</label>
            <input type="text" name="ean" id="ean" value="<?= htmlspecialchars($_POST['ean'] ?? '') ?>" required autofocus maxlength="13">
            <button type="submit">Buscar</button>
        </form>

        <?php if (!empty($mensagem)): ?>
            <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>

        <?php if ($produto): ?>
            <form method="post" action="/consultapolitica/controllers/ProdutoController.php" onsubmit="return confirm('Tem certeza que deseja atualizar este produto?');">
                <input type="hidden" name="acao" value="atualizar">
                <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>">
                <input type="hidden" name="ean" value="<?= htmlspecialchars($produto['ean']) ?>">

                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($produto['nome_produto']) ?>" required>

                <label for="fabricante">Fabricante:</label>
                <input type="text" name="fabricante" id="fabricante" value="<?= htmlspecialchars($produto['fabricante']) ?>" required>

                <label for="codigo_interno">Código Interno:</label>
                <input type="text" name="codigo_interno" id="codigo_interno" value="<?= htmlspecialchars($produto['codigo_interno']) ?>" required>

                <label for="politica_troca">Política de Troca:</label>
                <textarea name="politica_troca" id="politica_troca" required><?= htmlspecialchars($produto['politica_troca']) ?></textarea>

                <button type="submit">Salvar Alterações</button>
            </form>
        <?php endif; ?>
    </div>
</section>
    <?php include_once "../components/footer.php"; ?>
</body>
</html>
