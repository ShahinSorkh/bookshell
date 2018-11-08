<?php
$login_required = true; $user_required = true; $current_page = 'user';
include_once __DIR__ . '/template/head.php';

$page = $_GET['page'] ?? $_POST['submit'] ?? null;
if ($page && is_file(__DIR__ . "/user/{$page}.php")) { include_once __DIR__ . "/user/{$page}.php"; } else { ?>

<ul>
    <li><a href="<?= $_SERVER['PHP_SELF']; ?>?page=list-orders">List orders</a></li>
</ul>

<?php } include_once __DIR__ . '/template/foot.php'; ?>
