<?php
$login_required = true;
$admin_required = true;
$current_page = 'admin';
include_once __DIR__ . '/../template/head.php';

$page = $_GET['page'] ?? null;
if ($page && is_file(__DIR__ . "/{$page}.php")) {
    include_once __DIR__ . "/{$page}.php";
} else { ?>
<main class="main">

<ul>
    <li><a href="<?= $_SERVER['PHP_SELF']; ?>?page=new-book">Create new book</a></li>
</ul>

</main>
<?php }

include_once __DIR__ . '/../template/foot.php';

