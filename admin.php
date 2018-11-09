<?php
$login_required = true; $admin_required = true; $current_page = 'admin';
include_once __DIR__ . '/template/head.php';

$page = $_GET['page'] ?? $_POST['submit'] ?? null;
if ($page === null) redirect('admin.php?page=list-books');
?>

<div class="container-fluid my-3">
    <div class="row">
        <div class="col">
            <?php if ($page && is_file(__DIR__ . "/admin/{$page}.php")) { include_once __DIR__ . "/admin/{$page}.php"; } ?>
        </div>
        <div class="col-md-3">
            <div class="list-group sticky-top rtl">
                <a class="list-group-item <?= $page === 'list-books' ? 'active':'' ?>" href="<?= $_SERVER['PHP_SELF']; ?>?page=list-books">فهرست کتاب ها</a>
                <a class="list-group-item <?= $page === 'new-book' ? 'active':'' ?>" href="<?= $_SERVER['PHP_SELF']; ?>?page=new-book">کتاب جدید</a>
                <a class="list-group-item <?= $page === 'list-orders' ? 'active':'' ?>" href="<?= $_SERVER['PHP_SELF']; ?>?page=list-orders">لیست سفارشات</a>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/template/foot.php'; ?>
