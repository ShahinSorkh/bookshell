<?php require_once __DIR__ . '/../includes/index.php';

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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
       <h5 class="my-0 mr-md-auto font-weight-normal">MY BOOKSHELL PRO</h5>
       <nav class="my-2 my-md-0 mr-md-3">
           <a class="p-2 text-dark" href="#">تماس با ما</a>
           <a class="p-2 text-dark" href="#">Enterprise</a>
           <a class="p-2 text-dark" href="#">Support</a>
           <a class="p-2 text-dark" href="#">Pricing</a>
       </nav>
       <a class="btn btn-outline-primary" href="#">ورود</a>
    </div>
    <!-- <header class="header"> -->
    <!--     <aside> -->
    <!--         <a href="<?= ROOT_URL ?>"><img src="<?= ROOT_URL ?>/assets/img/logo&#45;white&#45;512x512.png" alt="BOOK SHELL"></a> -->
	<!--     <form id="search&#45;form" action="<?= ROOT_URL ?>/index.php" method="get"> -->
    <!--             <input type="search" name="q" placeholder="جستجو..."> -->
    <!--         </form> -->
    <!--     </aside> -->
    <!--     <nav> -->
    <!--         <ul> -->
    <!--             <li><a href="<?= ROOT_URL ?>">MY BOOK SHELL</a></li> -->
	<!-- 	<li><a class="<?= $current_page === 'home' ? 'active' : ''; ?>" href="<?= ROOT_URL ?>"><i class="fa fa&#45;home"></i></a></li> -->
    <!--             <?php if (logged_in()): ?> -->
    <!--                 <li><a class="<?= $current_page === $user['role'] ? 'active' : ''; ?>" href="<?= ROOT_URL .'/'.$user['role']; ?>.php"><?= strtoupper($user['role']); ?></a></li> -->
	<!-- 	    <li><a href="<?= ROOT_URL ?>/logout.php">LOGOUT</a></li> -->
    <!--             <?php else: ?> -->
    <!--                 <li><a class="<?= $current_page === 'login' ? 'active' : ''; ?>" href="<?= ROOT_URL ?>/login.php">LOGIN</a></li> -->
    <!--             <?php endif; ?> -->
    <!--         </ul> -->
    <!--     </nav> -->
    <!--     <br style="clear: both;"> -->
    <!-- </header> -->
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

