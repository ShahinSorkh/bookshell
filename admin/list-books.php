<?php
$result = mysqli_query($db, 'select * from books');
if (!$result) die(mysqli_error($db));

$books = [];
while(($book = mysqli_fetch_assoc($result))) {
    $books[] = $book;
}
?>

<table class="table table-striped text-center rtl">
    <tr class="thead-dark">
        <th><a class="btn btn-sm" href="<?= $_SERVER['PHP_SELF']; ?>?page=new-book">+</a> ردیف</th>
        <th>کتاب</th>
        <th>قیمت</th>
        <th>توضیحات</th>
        <th>زمان ایجاد</th>
        <th>عملیات</th>
    </tr>
    <?php foreach ($books as $book): ?>
    <tr>
        <td><?= $book['id']; ?></td>
        <td>
            <img class="img-thumbnail ml-3" width="100" src="<?= ROOT_URL.'/'.$book['cover']; ?>" alt="<?= $book['name']; ?>">
            <?= $book['name']; ?>
        </td>
        <td><?= $book['price']; ?></td>
        <td><?= substr($book['description'], 0, 100); ?><?= strlen($book['description']) > 100 ? '[...]':'' ?></td>
        <td><?= $book['created_at']; ?></td>
        <td class="btn-group btn-group-sm" style="direction:ltr;">
            <a class="btn btn-danger" href="<?= $_SERVER['PHP_SELF']; ?>?page=delete-book&id=<?= $book['id']; ?>">حذف</a>
            <a class="btn btn-warning" href="<?= $_SERVER['PHP_SELF']; ?>?page=edit-book&id=<?= $book['id']; ?>">ویرایش</a>
            <a class="btn btn-info" href="<?= ROOT_URL.'/'.$book['path']; ?>">دریافت فایل</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
