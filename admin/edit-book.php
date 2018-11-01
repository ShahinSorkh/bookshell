<?php
$book_id = intval($_GET['id']);
$result = mysqli_query($db, "select * from books where id=$book_id limit 1");
if (!$result) redirect('admin.php?page=list-books', mysqli_error($db), 'danger');
if (mysqli_num_rows($result) < 1) redirect('admin.php?page=list-books', 'book not found', 'danger');

$book = mysqli_fetch_assoc($result);
if (isset($_POST['submit']) && $_POST['submit'] === 'edit-book') {

    $name = filter_var($_POST['name']);

    $description = filter_var($_POST['description']);
    $price = filter_var($_POST['price'], FILTER_VALIDATE_INT);

    $cover = $name && $_FILES['cover']['error'] === UPLOAD_ERR_OK
        ? save_uploaded_file('cover', 'books/' . md5($id) . '/cover')
        : filter_var($_POST['cover']);

    $file = $name && $_FILES['file']['error'] === UPLOAD_ERR_OK
        ? save_uploaded_file('file', 'books/' . md5($id) . '/file')
        : filter_var($_POST['file']);

    if ($name && $description && $price && $cover && $file) {
        $name = mysqli_real_escape_string($db, $name);
        $description = mysqli_real_escape_string($db, $description);
        $cover = mysqli_real_escape_string($db, $cover);

        $result = mysqli_query($db, "update books set name='$name', description='$description', path='$file', cover='$cover', price=$price where id=$book[id]");
        if (!$result) redirect('admin.php?page=list-books', mysqli_error($db), 'danger');
        else redirect('admin.php?page=list-books', 'book saved', 'success');
    } else redirect('admin.php?page=list-books', 'invalid input', 'danger');
}
?>
<form class="new-book-form" action="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $book['id']; ?>" method="post" enctype="multipart/form-data">
    <div class="field-box">
        <label for="cover">جلد</label>
        <input id="cover" type="file" name="cover" accept="image/*">
    </div>
    <input type="hidden" name="cover" value="<?= $book['cover']; ?>">
    <div class="field-box">
        <label for="file">فایل</label>
        <input id="file" type="file" name="file">
    </div>
    <input type="hidden" name="file" value="<?= $book['file']; ?>">
    <div style="float:right;width:50%;" class="field-box">
        <label for="name">نام کتاب</label>
        <input style="margin-right:10px;" id="name" type="text" name="name" value="<?= $book['name']; ?>">
    </div>
    <div style="float:right;width:50%;" class="field-box" value="<?= $book['name']; ?>">
        <label for="price">قیمت</label>
        <input style="margin-left:10px;" id="price" type="number" name="price" value="<?= $book['price']; ?>">
    </div>
    <div class="field-box">
        <label for="description">توضیحات</label>
        <textarea id="description" name="description"><?= $book['description']; ?></textarea>
    </div>
    <button type="submit" name="submit" value="edit-book">ذخیره</button>
</form>

