<?php
if (isset($_POST['submit']) && $_POST['submit'] === 'new-book') {

    $name = filter_var($_POST['name']);
    $description = filter_var($_POST['description']);
    $price = filter_var($_POST['price'], FILTER_VALIDATE_INT);
    if ($name && $description && $price
        && ($cover = save_uploaded_file('cover', 'books/' . md5(uniqid(rand())) . '/'.uniqid(rand(400,500))))
        && ($file = save_uploaded_file('file', 'books/' . md5(uniqid(rand())) . '/'.uniqid(rand(200,300))))
    ) {
        $name = mysqli_real_escape_string($db, $name);
        $description = mysqli_real_escape_string($db, $description);
        $cover = mysqli_real_escape_string($db, $cover);
        $file = mysqli_real_escape_string($db, $file);

        $result = mysqli_query($db, "insert into books (name,description,price,cover,path) values ('$name','$description',$price,'$cover','$file')");
        if (!$result) redirect('admin.php?page=list-books', mysqli_error($db), 'danger');
        else redirect('admin.php?page=list-books', 'book saved', 'success');
    } else redirect('admin.php?page=list-books', 'invalid input', 'danger');
}
?>

<form class="form-book rtl" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

    <div class="custom-file">
        <label class="custom-file-label" for="cover">جلد</label>
        <input class="custom-file-input" id="cover" type="file" name="cover" accept="image/*" required>
    </div>

    <div class="custom-file">
        <label class="custom-file-label" for="file">فایل</label>
        <input class="custom-file-input" id="file" type="file" name="file" required>
    </div>

    <div class="form-group">
        <label for="name">نام کتاب</label>
        <input class="form-control" style="margin-right:10px;" id="name" type="text" name="name" required autofocus>
    </div>

    <div class="form-group">
        <label for="price">قیمت</label>
        <input class="form-control" style="margin-left:10px;" id="price" type="number" name="price" required>
    </div>

    <div class="form-group">
        <label for="description">توضیحات</label>
        <textarea rows="7" class="form-control" id="description" name="description" required></textarea>
    </div>

    <button class="btn btn-lg btn-primary btn-block" name="submit" value="new-book" type="submit">ذخیره</button>
</form>
