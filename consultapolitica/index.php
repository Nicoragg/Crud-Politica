<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "sqlpolitica";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$produto = [];
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ean = trim($_POST["ean"]);

    if (!empty($ean)) {
        $stmt = $conn->prepare("SELECT ean, nome_produto, fabricante, codigo_interno, politica_troca FROM politicas_troca WHERE ean = ?");
        $stmt->bind_param("s", $ean);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $produto = $result->fetch_assoc();
        } else {
            $mensagem = "Nenhuma política de troca encontrada para este EAN. Verifique na loja!";
        }

        $stmt->close();
    } else {
        $mensagem = "Por favor, digite um EAN válido.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Consulta Política de Troca</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <header>        
        <div class="logo">
            <img src="view\logo.png" alt="Logo">
        </div>
        <div class="spacer">

        </div>
        <nav>
            <?php if (isset($_SESSION['admin'])): ?>
                <a href="view/?page=home"><button>Administrador</button></a>
            <?php else: ?>
                <a href="view/?page=login"><button>Administrador</button></a>
            <?php endif; ?>
        </nav>
    </header>
    <hr>
    <section>
        <h1>Consulta de Política de Troca</h1>
        <p>Digite o código EAN do produto para consultar a política de troca.</p>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="text" name="ean" placeholder="Digite o EAN do produto" required autofocus>
            <button type="submit">Consultar</button>
        </form>

        <?php if (!empty($produto)): ?>
            <div class="resultado">
                <h3>Detalhes do Produto</h3>
                <p><strong>EAN:</strong> <?= htmlspecialchars($produto['ean']) ?></p>
                <p><strong>Nome do Produto:</strong> <?= htmlspecialchars($produto['nome_produto']) ?></p>
                <p><strong>Fabricante:</strong> <?= htmlspecialchars($produto['fabricante']) ?></p>
                <p><strong>Código Interno:</strong> <?= htmlspecialchars($produto['codigo_interno']) ?></p>
                <p><strong>Política de Troca:</strong> <?= nl2br(htmlspecialchars($produto['politica_troca'])) ?></p>
            </div>
        <?php elseif (!empty($mensagem)): ?>
            <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>
    </section>

    <footer>
        <p>&copy;<?= date("Y") ?> - Todos os direitos reservados.</p>
    </footer>
</body>
</html>
