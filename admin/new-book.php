<?php
if (isset($_POST['submit']) && $_POST['submit'] === 'new-book') {

    $name = filter_var($_POST['name']);
    $description = filter_var($_POST['description']);
    $price = filter_var($_POST['price'], FILTER_VALIDATE_INT);
    if ($name && $description && $price && ($cover = save_uploaded_file('cover', 'books/' . md5($name)))) {
        $name = mysqli_real_escape_string($db, $name);
        $description = mysqli_real_escape_string($db, $description);
        $cover = mysqli_real_escape_string($db, $cover);

        $result = mysqli_query($db, "insert into books (name,description,price,cover) values ('$name','$description',$price,'$cover')");
        if (!$result) redirect('/admin.php?page=list-books', mysqli_error($db), 'danger');
        else redirect('/admin.php?page=list-books', 'book saved', 'success');
    } else redirect('/admin.php?page=list-books', 'invalid input', 'danger');
}
?>
<form class="new-book-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <div class="field-box">
        <label for="cover">جلد</label>
        <input id="cover" type="file" name="cover" accept="image/*">
    </div>
    <div style="float:right;width:50%;" class="field-box">
        <label for="name">نام کتاب</label>
        <input style="margin-right:10px;" id="name" type="text" name="name">
    </div>
    <div style="float:right;width:50%;" class="field-box">
        <label for="price">قیمت</label>
        <input style="margin-left:10px;" id="price" type="number" name="price">
    </div>
    <div class="field-box">
        <label for="description">توضیحات</label>
        <textarea id="description" name="description"></textarea>
    </div>
    <button type="submit" name="submit" value="new-book">ذخیره</button>
</form>

