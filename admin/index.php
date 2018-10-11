<?php
$login_required = true;
$admin_required = true;
$current_page = 'admin';
ob_start();
include_once __DIR__ . '/../template/head.php';

$page = $_GET['page'] ?? $_POST['submit'] ?? null;
if ($page && is_file(__DIR__ . "/{$page}.php")) {
    include_once __DIR__ . "/{$page}.php";
} else { ?>

<ul>
    <li><a href="<?= $_SERVER['PHP_SELF']; ?>?page=list-books">List books</a></li>
    <li><a href="<?= $_SERVER['PHP_SELF']; ?>?page=new-book">Create new book</a></li>
    <li><a href="<?= $_SERVER['PHP_SELF']; ?>?page=list-orders">List orders</a></li>
</ul>

<?php }

include_once __DIR__ . '/../template/foot.php';

