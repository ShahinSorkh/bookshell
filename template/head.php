<?php require_once __DIR__ . '/../includes/index.php';

if (isset($login_required) && $login_required) redirect_if_not_logged_in();
if (isset($admin_required) && $admin_required) redirect_if_not_admin();
if (isset($user_required) && $user_required) redirect_if_not_user();
if (isset($guest_required) && $guest_required) redirect_if_logged_in();
$current_page = $current_page ?? 'home';
if (logged_in()) $user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en" class="bg-light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MY BOOK SHELL</title>
    <?php if (DEBUG): ?>
        <link rel="stylesheet" href="<?= ROOT_URL ?>/assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= ROOT_URL ?>/assets/css/bootstrap.min.css">
    <?php else: ?>
        <link rel="stylesheet" href="https://unpkg.com/font-awesome@4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <?php endif; ?>
    <link rel="stylesheet" href="<?= ROOT_URL ?>/assets/css/style.css">
    <link rel="icon" href="<?= ROOT_URL ?>/favicon.ico">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="py-0 navbar-brand" href="<?= ROOT_URL ?>">
            <img height="40" src="<?= ROOT_URL ?>/assets/img/logo-white-512x512.png" alt="BOOK SHELL">
            MY BOOKSHELL PRO
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars"
                aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbars">
            <ul class="navbar-nav mr-auto float-right">
                <li class="nav-item <?= $current_page === 'home' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= ROOT_URL ?>"><i class="fa fa-home"></i></a>
                </li>
                <li class="nav-item <?= $current_page === 'contactus' ? 'active' : ''; ?>">
                    <a class="nav-link" href="#">تماس با ما</a>
                </li>
                <?php if (logged_in()): ?>
                    <li class="nav-item <?= $current_page === $user['role'] ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= ROOT_URL .'/'.$user['role']; ?>.php">پنل کاربری</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT_URL ?>/logout.php">خروج</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item <?= $current_page === 'contactus' ? 'active' : ''; ?>">
                        <a class="nav-link <?= $current_page === 'login' ? 'active' : ''; ?>" href="<?= ROOT_URL ?>/login.php">ورود</a>
                    </li>
                <?php endif; ?>
            </ul>
            <form action="<?= ROOT_URL ?>/index.php" class="form-inline my-2 my-lg-0" method="get">
                <input name="q" class="form-control mr-sm-2" style="direction:rtl;" type="text" placeholder="جستجو..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">جستجو</button>
            </form>
        </div>
    </nav>

    <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert alert-<?= $_SESSION['msg-type']; ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['msg']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
        unset($_SESSION['msg']);
        unset($_SESSION['msg-type']);
        ?>
    <?php endif; ?>
    <main role="main">
