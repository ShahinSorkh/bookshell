<?php
require_once __DIR__ . '/../includes/index.php';
if (isset($login_required) && $login_required) redirect_if_not_logged_in();
if (isset($admin_required) && $admin_required) redirect_if_not_admin();
if (isset($user_required) && $user_required) redirect_if_not_user();
if (isset($guest_required) && $guest_required) redirect_if_logged_in();
$current_page = $current_page ?? 'home';
if (logged_in()) $user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MY BOOK SHELL</title>
    <?php if (DEBUG): ?>
        <link rel="stylesheet" href="<?= ROOT_URL ?>/assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= ROOT_URL ?>/assets/css/bootstrap.min.css">
    <?php else: ?>
        <link rel="stylesheet" href="https://unpkg.com/font-awesome@4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <?php endif; ?>
    <link rel="icon" href="<?= ROOT_URL ?>/favicon.ico">
</head>
<body>
<div class="wrapper">
    <header class="header">
        <aside>
            <a href="<?= ROOT_URL ?>"><img src="<?= ROOT_URL ?>/assets/img/logo-white-512x512.png" alt="BOOK SHELL"></a>
	    <form id="search-form" action="<?= ROOT_URL ?>/index.php" method="get">
                <input type="search" name="q" placeholder="جستجو...">
            </form>
        </aside>
        <nav>
            <ul>
                <li><a href="<?= ROOT_URL ?>">MY BOOK SHELL</a></li>
		<li><a class="<?= $current_page === 'home' ? 'active' : ''; ?>" href="<?= ROOT_URL ?>"><i class="fa fa-home"></i></a></li>
                <?php if (logged_in()): ?>
                    <li><a class="<?= $current_page === $user['role'] ? 'active' : ''; ?>" href="<?= ROOT_URL .'/'.$user['role']; ?>.php"><?= strtoupper($user['role']); ?></a></li>
		    <li><a href="<?= ROOT_URL ?>/logout.php">LOGOUT</a></li>
                <?php else: ?>
                    <li><a class="<?= $current_page === 'login' ? 'active' : ''; ?>" href="<?= ROOT_URL ?>/login.php">LOGIN</a></li>
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
    <main class="main">

