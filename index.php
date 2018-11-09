<?php include_once __DIR__.'/template/head.php'; ?>
<?php

if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    $q = mysqli_real_escape_string($db, trim($_GET['q']));
    $query = "SELECT * FROM books where name like '%$q%'";
} else {
    $query = 'select * from books';
}

$result = mysqli_query($db, $query);
if (!$result) {
    die(mysqli_error($db));
}

$books = [];
while (($book = mysqli_fetch_assoc($result))) {
    $books[] = $book;
}
?>
<div class="container-fluid py-3">
    <div class="row rtl">
        <?php foreach ($books as $book): ?>
        <div class="col-md-2">
            <div class="card mb-4 shadow-sm">
                <div class="card-header text-center"><a href="<?= ROOT_URL ?>/book.php?id=<?= $book['id'] ?>"><?= $book['name'] ?></a></div>
                <img class="card-img-top" src="<?= ROOT_URL.$book['cover'] ?>" alt="<?= $book['name'] ?>">
                <div class="card-body">
                    <p class="card-text">
                        <?= substr($book['description'], 0, 100); ?>
                        <?= strlen($book['description']) > 100 ? '[...]' : ''; ?>
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="<?= ROOT_URL ?>/book.php?id=<?= $book['id']; ?>" class="btn btn-sm btn-outline-secondary">بیشتر بخوانید</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include_once __DIR__.'/template/foot.php'; ?>
