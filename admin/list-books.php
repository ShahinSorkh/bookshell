<?php
$result = mysqli_query($db, 'select * from books');
if (!$result) die(mysqli_error($db));

$books = [];
while(($book = mysqli_fetch_assoc($result))) {
    $books[] = $book;
}
?>
<table class="list-books">
    <tr>
        <th>ردیف</th>
        <th>جلد</th>
        <th>نام کتاب</th>
        <th>قیمت</th>
        <th>توضیحات</th>
        <th>زمان ایجاد</th>
        <th>عملیات</th>
    </tr>
    <?php foreach ($books as $book): ?>
    <tr>
        <td><?= $book['id']; ?></td>
        <td style="width:200px;"><img src="<?= $book['cover']; ?>" alt="<?= $book['name']; ?>"></td>
        <td><?= $book['name']; ?></td>
        <td><?= $book['price']; ?></td>
        <td><?= $book['description']; ?></td>
        <td><?= $book['created_at']; ?></td>
        <td>
            <a class="action" href="<?= $_SERVER['PHP_SELF']; ?>?page=edit-book&id=<?= $book['id']; ?>">ویرایش</a>
            <a class="action" href="<?= $_SERVER['PHP_SELF']; ?>?page=delete-book&id=<?= $book['id']; ?>">حذف</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
