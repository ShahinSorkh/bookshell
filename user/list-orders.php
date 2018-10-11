<?php
$filter = $_GET['filter'] ?? 'all';
$user = $_SESSION['user'];

switch ($filter) {
case 'delivered':
    $result = mysqli_query($db, "select * from orders where user_id=$user[id] and delivered_at is not null");
    break;
case 'not-delivered':
    $result = mysqli_query($db, "select * from orders where user_id=$user[id] and delivered_at is null");
    break;
case 'all':
default:
    $result = mysqli_query($db, "select * from orders where user_id=$user[id]");
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

    $orders[] = $order;
}
?>
<ul class="inline">
    <li><a href="/user.php?page=list-orders&filter=all">همه</a></li>
    <li><a href="/user.php?page=list-orders&filter=delivered">تحویل شده ها</a></li>
    <li><a href="/user.php?page=list-orders&filter=not-delivered">تحویل نشده ها</a></li>
</ul>
<table class="list-books">
    <tr>
        <th>ردیف</th>
        <!-- <th>جلد</th> -->
        <th>نام کتاب</th>
        <th>قیمت</th>
        <th>عملیات</th>
    </tr>
    <?php foreach ($orders as $order): ?>
    <tr>
        <td><?= $order['book']['id']; ?></td>
        <!-- <td style="width:200px;"><img src="<?= $order['book']['cover']; ?>" alt="<?= $order['book']['name']; ?>"></td> -->
        <td><?= $order['book']['name']; ?></td>
        <td><?= $order['book']['price']; ?></td>
        <td>
            <?php if ($order['delivered_at']): ?>
                <a class="action" href="<?= $order['book']['path']; ?>">دریافت کتاب</a>
            <?php else: ?>
                در انتظار
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

