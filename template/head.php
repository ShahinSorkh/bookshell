<?php
require_once __DIR__ . '/../includes/index.php';
if (isset($login_required) && $login_required) redirect_if_not_logged_in();
if (isset($admin_required) && $admin_required) redirect_if_not_admin();
if (isset($guest_required) && $guest_required) redirect_if_logged_in();
$current_page = $current_page ?? 'home';
if (logged_in()) $user = $_SESSION['user'];
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
<div class="wrapper">
    <header class="header">
        <aside>
            <a href="/"><img src="/assets/img/logo-white-512x512.png" alt="BOOK SHELL"></a>
        </aside>
        <nav>
            <ul>
                <li><a href="/">MY BOOK SHELL</a></li>
                <li><a class="<?= $current_page === 'home' ? 'active' : ''; ?>" href="/"><i class="fa fa-home"></i></a></li>
                <?php if (logged_in()): ?>
                    <li><a class="<?= $current_page === $user['role'] ? 'active' : ''; ?>" href="/<?= $user['role']; ?>/index.php"><?= strtoupper($user['role']); ?></a></li>
                    <li><a href="/logout.php">LOGOUT</a></li>
                <?php else: ?>
                    <li><a class="<?= $current_page === 'login' ? 'active' : ''; ?>" href="/login.php">LOGIN</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <br style="clear: both;">
    </header>
    <?php if (isset($_SESSION['msg'])): ?>
        <div class="msg <?= $_SESSION['msg-type']; ?>">
            <p><?= $_SESSION['msg']; ?></p>
        </div>
        <?php
        unset($_SESSION['msg']);
        unset($_SESSION['msg-type']);
        ?>
    <?php endif; ?>

