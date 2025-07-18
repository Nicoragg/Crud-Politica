<?php
//Wevyllyn
//estockAdmin2025
//Nicolas
//senhaAdmin2025
//Admin
//senhaAdmin2025
session_start();
$acao = $_POST['acao'] ?? null;

if ($acao === 'login') {
    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);

    if (empty($usuario) || empty($senha)) {
        $_SESSION['login_erro'] = "Usuário e senha são obrigatórios.";
        header("Location: /consultapolitica/view/login.php");
        exit;
    }

    $conn = new mysqli("127.0.0.1", "root", "", "sqlpolitica");
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT senha FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($hash_senha);
    if ($stmt->fetch()) {
        if (md5($senha) === $hash_senha) {
            $_SESSION['admin'] = $usuario;
            header("Location: /consultapolitica/view/index.php");
            exit;
        }
    }

    $_SESSION['login_erro'] = "Usuário ou senha inválidos.";
    header("Location: /consultapolitica/view/login.php");
    exit;
}

if ($acao === 'logout') {
    session_destroy();
    header("Location: /consultapolitica/view/index.php");
    exit;
}
