<?php

$order_id = intval($_GET['id']);
$result = mysqli_query($db, "select * from orders where id=$order_id limit 1");
if (!$result) {
    redirect('admin.php?page=list-orders', mysqli_error($db), 'danger');
}
if (mysqli_num_rows($result) < 1) {
    redirect('admin.php?page=list-orders', 'موردی یافت نشد', 'danger');
}

$order = mysqli_fetch_assoc($result);

if (mysqli_query($db, "update orders set delivered_at=now() where id=$order[id] limit 1")) {
    redirect('admin.php?page=list-orders', 'سفارش تحویل شد', 'success');
} else {
    redirect('admin.php?page=list-orders', 'تحویل سفارش با خطا روبرو شد: '.mysqli_error($db), 'danger');
}
