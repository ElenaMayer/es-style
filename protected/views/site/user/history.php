<div class="lc">
    <?php $this->renderPartial('user/_user_menu'); ?>
    <div class="history table__column table__column_right">
        <div class="table__cell">
            <h1 class="account-header__title">Мои заказы</h1>
            <?php if(!empty($history)) :?>
                <table class="orders">
                    <thead>
                    <tr class="orders__row_head">
                        <th class="orders__cell orders__cell_nr">Заказ</th>
                        <th class="orders__cell orders__cell_date">Дата</th>
                        <th class="orders__cell orders__cell_dest">Адресат</th>
                        <th class="orders__cell orders__cell_price">Сумма заказа</th>
                        <th class="orders__cell">Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($history as $order) :?>
                            <tr>
                                <td class="orders__cell">
                                    <a href="/history/<?= $order->id ?>" class="orders__cell-link"><?= $order->id ?></a>
                                </td>
                                <td class="orders__cell"><?= date("d.n.Y", strtotime($order->date_create)); ?></td>
                                <td class="orders__cell"><?= $order->user->name ?> <?= $order->user->surname ?></td>
                                <td class="orders__cell orders__cell_price"><?= $order->total ?></td>
                                <td class="orders__cell"><?=Yii::app()->params['orderStatuses'][$order->status]?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else :?>
                <div class="order_empty"><h3>У Вас пока нет заказов</h3></div>
            <?php endif; ?>
        </div>
    </div>
</div>