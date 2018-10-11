<?php
$book_id = intval($_GET['id']);
$result = mysqli_query($db, "select * from books where id=$book_id limit 1");
if (!$result) redirect("/book.php?id=$book_id", mysqli_error($db), 'danger');
if (mysqli_num_rows($result) < 1) redirect("/book.php?id=$book_id", 'book not found', 'danger');

$book = mysqli_fetch_assoc($result);
$user = $_SESSION['user'];

$result = mysqli_query($db, "insert into orders (user_id,book_id,price) values ($user[id],$book[id],$book[price])");
if (!$result) redirect("/book.php?id=$book[id]", mysqli_error($db), 'danger');
redirect('/index.php', 'خرید شما با موفقیت ثبت شد', 'success');

