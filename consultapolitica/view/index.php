<?php
session_start();

$page = $_GET['page'] ?? 'home';
$publicPages = ['login'];

if (!in_array($page, $publicPages) && !isset($_SESSION['admin'])) {
    header("Location: index.php?page=login");
    exit;
}

require_once "../components/header.php";
echo "<main class='container'>";

$routes = [
    'home'   => 'pages/home.php',
    'create' => 'pages/create.php',
    'update' => 'pages/update.php',
    'delete' => 'pages/delete.php',
    'login'  => 'pages/login.php',
    'logout' => 'pages/logout.php',
];

if (array_key_exists($page, $routes)) {
    require_once $routes[$page];
} else {
    require_once './pages/404.php';
}

echo "</main>";
require_once "../components/footer.php";
