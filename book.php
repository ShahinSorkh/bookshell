<?php
ob_start();
include_once __DIR__ . '/template/head.php';

$book_id = intval($_GET['id']);
$result = mysqli_query($db, "select * from books where id=$book_id limit 1");
if (!$result) redirect('index.php', mysqli_error($db), 'danger');
if (mysqli_num_rows($result) < 1) redirect('index.php', 'book not found', 'danger');

$book = mysqli_fetch_assoc($result);
?>

<div class="container py-3">
    <div class="card">
        <h4 class="card-header text-center"><?= $book['name'] ?></h4>
        <div class="card-body">
            <img class="card-img w-25 ml-4 float-right" src="<?= ROOT_URL.'/'.$book['cover']; ?>" alt="<?= $book['name'] ?>">
            <p class="card-text rtl"><?= nl2br($book['description']); ?></p>
        </div>
        <div class="card-footer">
        <?php if (logged_in()): ?>
            <a href="<?= ROOT_URL ?>/user.php?page=order&id=<?= $book['id']; ?>" class="btn btn-primary">سفارش خرید</a>
        <?php else: ?>
            <a href="<?= ROOT_URL ?>/login.php" class="btn btn-primary">برای خرید باید وارد شوید</a>
        <?php endif; ?>
            <span class="mx-3"><?= $book['price']; ?> تومان</span>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/template/foot.php'; ?>
