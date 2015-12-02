<div class="lc">
    <?php $this->renderPartial('user/_user_menu'); ?>
    <div class="history table__column table__column_right">
        <div class="table__cell">
            <header class="account-header">
                <h1 class="account-header__title">
                    <a href="/history/">Мои заказы</a>
                </h1>
                <h3 class="account-header__subtitle">№ <?= $order->id ?> от <?= date("d.n.Y", strtotime($order->date_create)); ?></h3>
            </header>
            <dl class="order-data">
                <dt class="order-data__label">Статус</dt>
                <dd class="order-data__value"><?=Yii::app()->params['orderStatuses'][$order->status]?>&nbsp;</dd>
                <dt class="order-data__label">Сумма</dt>
                <dd class="order-data__value">
                    <table class="order-data__table">
                        <tbody>
                        <tr class="order-data__table-row">
                            <td class="order-data__table-cell">Подытог</td>
                            <td class="order-data__table-cell order-data__table-cell_right"><?= $order->subtotal ?>&nbsp;руб.</td>
                        </tr>
                        <?php if($order->sale > 0) :?>
                            <tr class="order-data__table-row">
                                <td class="order-data__table-cell">Скидка</td>
                                <td class="order-data__table-cell order-data__table-cell_right"><?= $order->sale ?>&nbsp;руб.</td>
                            </tr>
                        <?php endif ?>
                        <tr class="order-data__table-row">
                            <td class="order-data__table-cell">Доставка</td>
                            <td class="order-data__table-cell order-data__table-cell_right"><?= $order->shipping ?>&nbsp;руб.</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr class="order-data__table-row order-data__table-row_amount">
                            <td class="order-data__table-cell">Итого</td>
                            <td class="order-data__table-cell order-data__table-cell_right"><?= $order->total ?>&nbsp;руб.</td>
                        </tr>
                        </tfoot>
                    </table>&nbsp;
                </dd>
                <dt class="order-data__label">Способ оплаты</dt>
                <dd class="order-data__value"><?= Yii::app()->params['paymentMethod'][$order->payment_method];?>&nbsp;</dd>
                <dt class="order-data__label">Доставка</dt>
                <dd class="order-data__value">
                    <div class="order-data__value-row"><?= Yii::app()->params['shippingMethod'][$order->shipping_method];?></div>
                    <table class="order-data__table order-data__table_top-margin">
                        <tbody>
                        <tr class="order-data__table-row">
                            <td class="order-data__table-cell">Адрес</td>
                            <td class="order-data__table-cell order-data__table-cell_right"><?= $order->address ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="order-data__table order-data__table_top-margin">
                        <tbody>
                        <tr class="order-data__table-row">
                            <td class="order-data__table-cell">Получатель</td>
                            <td class="order-data__table-cell order-data__table-cell_right"><?= $order->addressee ?></td>
                        </tr>
                        </tbody>
                    </table>&nbsp;
                </dd>
            </dl>
            <ul class="cart-list__content">
                <?php foreach($order->cartItems as $cartItem) :?>
                <li class="cart-item">
                    <?php $this->renderPartial('user/_history_item_base', array('cartItem'=>$cartItem)); ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>