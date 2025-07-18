<?php

if (isset($_SESSION['admin'])) {
    header("Location: index.php?page=home");
    exit;
}

$mensagem = $_SESSION['login_erro'] ?? '';
unset($_SESSION['login_erro']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    
    <section>
        <div class="login">
            <h1>Login Administrador</h1>
            <?php if (!empty($mensagem)): ?>
                <div class="erro"><?= htmlspecialchars($mensagem) ?></div>
            <?php endif; ?>
            <form action="..\controllers\AuthController.php" method="POST">
                <input type="hidden" name="acao" value="login">
                <label for="usuario">Usuário:</label>
                <input type="text" name="usuario" required autofocus>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" required>
                <button type="submit">Entrar</button>
            </form>
            <p><a href="../index.php">← Voltar para consulta</a></p>
        </div>
            </section>
</body>
</html>
