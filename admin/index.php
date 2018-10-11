<?php
$login_required = true;
$admin_required = true;
$current_page = 'admin';
include_once __DIR__ . '/../template/head.php';

$page = $_GET['page'] ?? null;
if ($page && is_file(__DIR__ . "/{$page}.php")) {
    include_once __DIR__ . "/{$page}.php";
} else {
    redirect('/index.php', 'page not found');
}

include_once __DIR__ . '/../template/foot.php';

