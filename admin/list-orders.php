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
    $result = mysqli_query($db, 'select * from orders');
    break;
default:
    redirect('admin.php?page=list-orders');
}
if (!$result) die(mysqli_error($db));

$orders = [];
while(($order = mysqli_fetch_assoc($result))) {

    $aresult = mysqli_query($db, "select * from books where id=$order[book_id] limit 1");
    if (!$aresult) redirect('admin.php', mysqli_error($db), 'danger');
    $order['book'] = mysqli_fetch_assoc($aresult);

    $bresult = mysqli_query($db, "select * from users where id=$order[user_id] limit 1");
    if (!$bresult) redirect('admin.php', mysqli_error($db), 'danger');
    $order['user'] = mysqli_fetch_assoc($bresult);

    $orders[] = $order;
}
?>

<div class="row text-center rtl mb-3">
    <div class="col"><a class="list-group-item <?= $filter === 'all' ? 'active':'' ?>" href="<?= ROOT_URL ?>/admin.php?page=list-orders&filter=all">همه</a></div>
    <div class="col"><a class="list-group-item <?= $filter === 'delivered' ? 'active':'' ?>" href="<?= ROOT_URL ?>/admin.php?page=list-orders&filter=delivered">تحویل شده ها</a></div>
    <div class="col"><a class="list-group-item <?= $filter === 'not-delivered' ? 'active':'' ?>" href="<?= ROOT_URL ?>/admin.php?page=list-orders&filter=not-delivered">تحویل نشده ها</a></div>
</div>

<table class="table table-striped text-center rtl">
    <tr class="thead-dark">
        <th>کتاب</th>
        <th>قیمت</th>
        <th>کاربر</th>
        <th>ایمیل</th>
        <th>عملیات</th>
    </tr>
    <?php foreach ($orders as $order): ?>
    <tr>
        <td>
            <img class="img-thumbnail mx-3" width="100" src="<?= ROOT_URL.$order['book']['cover']; ?>" alt="<?= $order['book']['name']; ?>">
            <?= $order['book']['name']; ?>
        </td>
        <td><?= $order['book']['price']; ?></td>
        <td><?= $order['user']['username']; ?></td>
        <td><?= $order['user']['email']; ?></td>
        <td>
            <?php if ($order['delivered_at']): ?>
                <a class="btn btn-sm btn-success disabled" href="#">تحویل شده</a>
            <?php else: ?>
                <a class="btn btn-sm btn-info" href="<?= ROOT_URL ?>/admin.php?page=deliver-order&id=<?= $order['id']; ?>">تحویل شد</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
