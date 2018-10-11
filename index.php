<?php include_once __DIR__ . '/template/head.php'; ?>
<?php
$result = mysqli_query($db, 'select * from books');
if (!$result) die(mysqli_error($db));

$books = [];
while(($book = mysqli_fetch_assoc($result))) {
    $books[] = $book;
}

foreach($books as $book): ?>
    <section class="book-card">
        <header class="book-head">
            <a href="#"><h3><?= $book['name']; ?></h3></a>
        </header>
        <article class="book-body">
            <img src="<?= $book['cover']; ?>" alt="<?= $book['name']; ?>">
            <p><?= $book['description']; ?></p>
            <p><?= $book['price']; ?></p>
        </article>
        <footer class="book-foot"><a href="#">READ MORE</a></footer>
    </section>
<?php endforeach; ?>
<br style="clear: both;">
<?php include_once __DIR__ . '/template/foot.php'; ?>
