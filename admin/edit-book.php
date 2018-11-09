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
    $dir_name = basename(dirname($book['path']));

    $cover = $name && $_FILES['cover']['error'] === UPLOAD_ERR_OK
        ? save_uploaded_file('cover', 'books/' . $dir_name . '/'.uniqid(rand(400,500)))
        : filter_var($_POST['cover']);

    $file = $name && $_FILES['file']['error'] === UPLOAD_ERR_OK
        ? save_uploaded_file('file', 'books/' . $dir_name . '/'.uniqid(rand(200,300)))
        : filter_var($_POST['file']);

    if ($name && $description && $price && $cover && $file) {
        $name = mysqli_real_escape_string($db, $name);
        $description = mysqli_real_escape_string($db, $description);
        $cover = mysqli_real_escape_string($db, $cover);
        $file = mysqli_real_escape_string($db, $file);

        $result = mysqli_query($db, "update books set name='$name', description='$description', path='$file', cover='$cover', price=$price where id=$book[id]");
        if (!$result) redirect('admin.php?page=list-books', mysqli_error($db), 'danger');
        else redirect('admin.php?page=list-books', 'book saved', 'success');
    } else redirect('admin.php?page=list-books', 'invalid input', 'danger');
}
?>

<form class="form-book rtl" action="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $book['id'] ?>" method="post" enctype="multipart/form-data">
    <div class="text-center mb-4">
        <h2 class="h3 mb-3 font-weight-normal rounded text-light bg-info">ویرایش کتاب <em><?= $book['name'] ?></em></h2>
    </div>

    <div class="custom-file">
        <label class="custom-file-label" for="cover">جلد</label>
        <input class="custom-file-input" id="cover" type="file" name="cover" accept="image/*">
    </div>

    <div class="custom-file">
        <label class="custom-file-label" for="file">فایل</label>
        <input class="custom-file-input" id="file" type="file" name="file">
    </div>

    <div class="form-group">
        <label for="name">نام کتاب</label>
        <input class="form-control" style="margin-right:10px;" id="name" type="text" name="name" value="<?= $book['name'] ?>" required autofocus>
    </div>

    <div class="form-group">
        <label for="price">قیمت</label>
        <input class="form-control" style="margin-left:10px;" id="price" type="number" name="price" value="<?= $book['price'] ?>" required>
    </div>

    <div class="form-group">
        <label for="description">توضیحات</label>
        <textarea rows="7" class="form-control" id="description" name="description" required><?= $book['description'] ?></textarea>
    </div>

    <button class="btn btn-lg btn-primary btn-block" name="submit" value="edit-book" type="submit">ذخیره</button>
</form>
