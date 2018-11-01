<?php
ob_start();
include_once __DIR__.'/template/head.php';

$book_id = intval($_GET['id']);
$result = mysqli_query($db, "select * from books where id=$book_id limit 1");
if (!$result) {
    redirect('index.php', mysqli_error($db), 'danger');
}
if (mysqli_num_rows($result) < 1) {
    redirect('index.php', 'book not found', 'danger');
}

$book = mysqli_fetch_assoc($result);
?>
<header class="book-head">
    <h3><?= $book['name']; ?></h3>
</header>
<article class="book-body">
    <img src="<?= ROOT_URL.'/'.$book['cover']; ?>" alt="<?= $book['name']; ?>">
    <p style="direction:rtl;"><?= nl2br($book['description']); ?></p>
    <p style="direction:rtl;"><?= $book['price']; ?> تومان</p>
</article>
<?php if (logged_in()): ?>
    <footer class="book-foot"><a href="<?= ROOT_URL ?>/user.php?page=order&id=<?= $book['id']; ?>">سفارش خرید</a></footer>
    <br style="clear: both;">
<?php else: ?>
    <footer class="book-foot"><a href="<?= ROOT_URL ?>/login.php">برای خرید باید وارد شوید</a></footer>
    <br style="clear: both;">
<?php endif; ?>
<?php include_once __DIR__.'/template/foot.php'; ?>
