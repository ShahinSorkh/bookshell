<?php include_once __DIR__ . '/template/head.php'; ?>
<?php

if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    $q = mysqli_real_escape_string($db, trim($_GET['q']));
    $query = "SELECT * FROM books where name like '%$q%'";
} else $query = 'select * from books';

$result = mysqli_query($db, $query);
if (!$result) die(mysqli_error($db));

$books = [];
while(($book = mysqli_fetch_assoc($result))) {
    $books[] = $book;
}

foreach($books as $book): ?>
    <section class="book-card">
        <header class="book-head">
            <a href="<?= ROOT_URL ?>/book.php?id=<?= $book['id']; ?>"><h3><?= $book['name']; ?></h3></a>
        </header>
        <article class="book-body">
            <img src="<?= ROOT_URL.$book['cover']; ?>" alt="<?= $book['name']; ?>">
            <p style="direction:rtl;">
                <?= substr($book['description'], 0, 100); ?>
                <?= strlen($book['description']) > 100 ? '[...]':''; ?>
            </p>
            <p style="direction:rtl;"><?= $book['price']; ?> تومان</p>
        </article>
        <footer class="book-foot"><a href="<?= ROOT_URL ?>/book.php?id=<?= $book['id']; ?>">بیشتر بخوانید</a></footer>
    </section>
<?php endforeach; ?>
<br style="clear: both;">
<?php include_once __DIR__ . '/template/foot.php'; ?>
