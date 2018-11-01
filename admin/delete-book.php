<?php
$book_id = intval($_GET['id']);
$result = mysqli_query($db, "select * from books where id=$book_id limit 1");
if (!$result) redirect('admin.php?page=list-books', mysqli_error($db), 'danger');
if (mysqli_num_rows($result) < 1) redirect('admin.php?page=list-books', 'book not found', 'danger');

$book = mysqli_fetch_assoc($result);

if (mysqli_query($db, "delete from books where id=$book[id] limit 1")) {
    $dir = ROOT_DIR . dirname($book['cover']);
    if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $file) if (is_file("$dir/$file")) unlink("$dir/$file");
        rmdir($dir);
    }
    redirect('admin.php?page=list-books', 'book deleted', 'success');
} else redirect('admin.php?page=list-books', 'could not delete: ' . mysqli_error($db), 'danger');

