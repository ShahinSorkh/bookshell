<?php
$login_required = true; $user_required = true; $current_page = 'user';
include_once __DIR__.'/template/head.php';

$page = $_GET['page'] ?? $_POST['submit'] ?? null;
if ($page === null) {
    redirect('user.php?page=list-orders');
}
?>

<div class="container-fluid my-3">
    <div class="row">
        <div class="col">
            <?php if ($page && is_file(__DIR__."/user/{$page}.php")) {
    include_once __DIR__."/user/{$page}.php";
} ?>
        </div>
        <div class="col-md-3">
            <div class="list-group sticky-top rtl">
                <a class="list-group-item <?= $page === 'list-orders' ? 'active' : '' ?>" href="<?= $_SERVER['PHP_SELF']; ?>?page=list-orders">فهرست سفارشات</a>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__.'/template/foot.php'; ?>
