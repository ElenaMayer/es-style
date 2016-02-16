<table class="orders">
    <thead>
    <tr class="orders__row_head">
        <th class="orders__cell orders__cell_nr">Заказ</th>
        <th class="orders__cell orders__cell_date">Дата</th>
        <th class="orders__cell orders__cell_price">Сумма заказа</th>
        <th class="orders__cell">Статус</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($orders as $order) :?>
        <tr>
            <td class="orders__cell">
                <a href="/admin/orderHistory/update?id=<?= $order->id ?>" class="orders__cell-link"><?= $order->id ?></a>
            </td>
            <td class="orders__cell"><?= date("d.m.Y", strtotime($order->date_create)); ?></td>
            <td class="orders__cell orders__cell_price"><?= $order->total ?></td>
            <td class="orders__cell"><?=Yii::app()->params['orderStatuses'][$order->status]?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>