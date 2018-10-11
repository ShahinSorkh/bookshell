<?php

$login_required = true;
$user_required = true;
$current_page = 'user';
ob_start();
include_once __DIR__.'/../template/head.php';

$page = $_GET['page'] ?? null;
if ($page && is_file(__DIR__."/{$page}.php")) {
    include_once __DIR__."/{$page}.php";
} else {
    redirect('/index.php', 'page not found');
}

include_once __DIR__.'/../template/foot.php';
