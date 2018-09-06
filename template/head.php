<?php
require_once __DIR__ . '/../includes/index.php';
$current_page = $current_page ?? 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MY BOOK SHELL</title>
    <link rel="stylesheet" href="/assets/css/normalize.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="icon" href="/favicon.ico">
</head>
<body>
    <header class="header">
        <aside>
            <a href="/"><img src="/assets/img/logo-white-512x512.png" alt="BOOK SHELL"></a>
        </aside>
        <nav>
            <ul>
                <li><a href="/">MY BOOK SHELL</a></li>
                <li><a class="<?= $current_page === 'home' ? 'active' : ''; ?>" href="/"><i class="fa fa-home"></i></a></li>
                <li><a class="<?= $current_page === 'login' ? 'active' : ''; ?>" href="/login.php">LOGIN</a></li>
                <li><a class="<?= $current_page === 'user' ? 'active' : ''; ?>" href="#">USER</a></li>
            </ul>
        </nav>
        <br style="clear: both;">
    </header>

