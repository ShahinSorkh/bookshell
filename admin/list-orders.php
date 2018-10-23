<?php
$filter = $_GET['filter'] ?? 'all';

switch ($filter) {
case 'delivered':
    $result = mysqli_query($db, 'select * from orders where delivered_at is not null');
    break;
case 'not-delivered':
    $result = mysqli_query($db, 'select * from orders where delivered_at is null');
    break;
case 'all':
default:
    $result = mysqli_query($db, 'select * from orders');
}
if (!$result) {
    die(mysqli_error($db));
}

$orders = [];
while (($order = mysqli_fetch_assoc($result))) {
    $aresult = mysqli_query($db, "select * from books where id=$order[book_id] limit 1");
    if (!$aresult) {
        redirect('/admin.php', mysqli_error($db), 'danger');
    }
    $order['book'] = mysqli_fetch_assoc($aresult);

    $bresult = mysqli_query($db, "select * from users where id=$order[user_id] limit 1");
    if (!$bresult) {
        redirect('/admin.php', mysqli_error($db), 'danger');
    }
    $order['user'] = mysqli_fetch_assoc($bresult);

    $orders[] = $order;
}
?>
<ul class="inline">
    <li><a href="/admin.php?page=list-orders&filter=all">همه</a></li>
    <li><a href="/admin.php?page=list-orders&filter=delivered">تحویل شده ها</a></li>
    <li><a href="/admin.php?page=list-orders&filter=not-delivered">تحویل نشده ها</a></li>
</ul>
<table class="list-books">
    <tr>
        <th>ردیف</th>
        <!-- <th>جلد</th> -->
        <th>نام کتاب</th>
        <th>قیمت</th>
        <th>کاربر</th>
        <th>ایمیل</th>
        <th>عملیات</th>
    </tr>
    <?php foreach ($orders as $order): ?>
    <tr>
        <td><?= $order['book']['id']; ?></td>
        <!-- <td style="width:200px;"><img src="<?= $order['book']['cover']; ?>" alt="<?= $order['book']['name']; ?>"></td> -->
        <td><?= $order['book']['name']; ?></td>
        <td><?= $order['book']['price']; ?></td>
        <td><?= $order['user']['username']; ?></td>
        <td><?= $order['user']['email']; ?></td>
        <td>
            <?php if ($order['delivered_at']): ?>
                تحویل شده
            <?php else: ?>
                <a class="action" href="/admin.php?page=deliver-order&id=<?= $order['id']; ?>">تحویل شد</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

