<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Produto</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?php include_once "../components/header.php"; ?>
    <section><div class="container">
        <h2>Criar Produto</h2>
        <?php if (isset($_SESSION['errors'])): ?>
            <div class="errors">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; unset($_SESSION['errors']); ?>
            </div>
        <?php endif; ?>
        <form action="/consultapolitica/controllers/ProdutoController.php" method="POST" onsubmit="return confirm('Tem certeza que deseja criar este produto?')">
            <input type="hidden" name="acao" value="criar">
            <label>EAN:</label>
            <input type="text" name="ean" required maxlength="13">
            <label>Nome:</label>
            <input type="text" name="nome" required>
            <label>Fabricante:</label>
            <input type="text" name="fabricante" required>
            <label>Código Interno:</label>
            <input type="text" name="codigo_interno" required>
            <label>Política de Troca:</label>
            <textarea name="politica_troca" required></textarea>
            <button type="submit">Criar</button>
        </form>
    </div>
    </section>
    <?php include_once "../components/footer.php"; ?>
</body>
</html>