<?php
session_start();
include_once "../models/Produto.php";

$acao = $_POST['acao'] ?? null;

switch ($acao) {
    case 'criar':
        if (Produto::buscarPorEan($_POST['ean'])) {
            $_SESSION['errors'][] = "Já existe um produto cadastrado com o EAN informado.";
        } else {
            Produto::criar($_POST);
            $_SESSION['success'] = "Produto criado com sucesso!";
        }
        header("Location: ../view/index.php?page=create");
        exit;
    case 'atualizar':
        Produto::atualizar($_POST);
        $_SESSION['success'] = "Produto atualizado com sucesso!";
        header("Location: ../view/index.php?page=update");
        exit;
    case 'deletar':
        Produto::deletar($_POST['id']);
        $_SESSION['success'] = "Produto excluído com sucesso!";
        header("Location: ../view/index.php?page=delete");
        exit;
    case 'buscar':
        Produto::buscarPorEan($_POST['id']);
        break;
    }
header("Location: ../admin/update.php");
exit;
