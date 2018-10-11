<?php

$book_id = intval($_GET['id']);
$result = mysqli_query($db, "select * from books where id=$book_id limit 1");
if (!$result) {
    redirect('/admin/index.php?page=list-books', mysqli_error($db), 'danger');
}
if (mysqli_num_rows($result) < 1) {
    redirect('/admin/index.php?page=list-books', 'book not found', 'danger');
}

$book = mysqli_fetch_assoc($result);

if (unlink(ROOT_DIR.$book['cover']) && mysqli_query($db, "delete from books where id=$book[id] limit 1")) {
    redirect('/admin/index.php?page=list-books', 'book deleted', 'success');
} else {
    redirect('/admin/index.php?page=list-books', 'could not delete: '.mysqli_error($db), 'danger');
}
