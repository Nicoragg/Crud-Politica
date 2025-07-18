<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <section class="admin-panel">
        <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['admin']) ?>!</h1>
        <p>Você está no painel administrativo.</p>
        <ul>
            <li><a href="?page=create">Criar Produto</a></li>
            <li><a href="?page=update">Atualizar Produto</a></li>
            <li><a href="?page=delete">Excluir Produto</a></li>
            <li><a href="?page=logout">Sair</a></li>
        </ul>
    </section>
</body>
</html>
