<div class="lc">
    <?php $this->renderPartial('user/_user_menu'); ?>
    <div class="history table__column table__column_right">
        <div class="table__cell">
            <header class="account-header">
                <h1 class="account-header__title">
                    <a href="/history/">Мои заказы</a>
                </h1>
                <h3 class="account-header__subtitle">№ <?= $order->id ?> от <?= date("d.m.Y", strtotime($order->date_create)); ?></h3>
            </header>
            <dl class="order-data">
                <dt class="order-data__label">Статус</dt>
                <dd class="order-data__value"><?=Yii::app()->params['orderStatuses'][$order->status]?>&nbsp;</dd>
                <dt class="order-data__label">Сумма</dt>
                <dd class="order-data__value">
                    <table class="order-data__table">
                        <tbody>
                        <tr class="order-data__table-row">
                            <td class="order-data__table-cell">Подитог</td>
                            <td class="order-data__table-cell order-data__table-cell_right"><?= $order->subtotal ?>&nbsp;руб.</td>
                        </tr>
                        <?php if($order->sale > 0) :?>
                            <tr class="order-data__table-row">
                                <td class="order-data__table-cell">Скидка</td>
                                <td class="order-data__table-cell order-data__table-cell_right"><?= $order->sale ?>&nbsp;руб.</td>
                            </tr>
                        <?php endif ?>
                        <?php if($order->coupon_sale > 0) :?>
                            <tr class="order-data__table-row">
                                <td class="order-data__table-cell">Скидка по купону</td>
                                <td class="order-data__table-cell order-data__table-cell_right"><?= $order->coupon_sale ?>&nbsp;руб.</td>
                            </tr>
                        <?php endif ?>
                        <tr class="order-data__table-row">
                            <td class="order-data__table-cell">Доставка<?php if(Yii::app()->cart->isWholesale()) :?> до ТК<?php endif?></td>
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
                <?php if(!Yii::app()->cart->isWholesale()) :?>
                    <dt class="order-data__label">Способ оплаты</dt>
                    <dd class="order-data__value"><?= Yii::app()->params['paymentMethod'][$order->payment_method];?>&nbsp;</dd>
                <?php endif?>
                <dt class="order-data__label">Доставка</dt>
                <dd class="order-data__value">
                    <?php if(!Yii::app()->cart->isWholesale()) :?>
                        <div class="order-data__value-row"><?= Yii::app()->params['shippingMethod'][$order->shipping_method];?></div>
                    <?php endif?>
                    <table class="order-data__table order-data__table_top-margin">
                        <tbody>
                        <tr class="order-data__table-row">
                            <td class="order-data__table-cell">Получатель</td>
                            <td class="order-data__table-cell order-data__table-cell_right"><?= $order->addressee ?></td>
                        </tr>
                        </tbody>
                    </table>&nbsp;
                    <table class="order-data__table order-data__table_top-margin">
                        <tbody>
                        <?php if(Yii::app()->cart->isWholesale()) :?>
                            <tr class="order-data__table-row">
                                <td class="order-data__table-cell">Транспортная компания</td>
                                <td class="order-data__table-cell order-data__table-cell_right"><?= Yii::app()->params['tcList'][$order->user->tc]?></td>
                            </tr>
                        <?php endif?>
                        <?php if(Yii::app()->cart->isWholesale() && $order->user->tc != 'pr') :?>
                        <tr class="order-data__table-row">
                            <td class="order-data__table-cell">Данные для доставки</td>
                            <td class="order-data__table-cell order-data__table-cell_right"><?= $order->user->delivery_data?></td>
                        </tr>
                        <?php endif?>
                        <?php if(!Yii::app()->cart->isWholesale() || $order->user->tc == 'pr') :?>
                        <tr class="order-data__table-row">
                            <td class="order-data__table-cell">Адрес</td>
                            <td class="order-data__table-cell order-data__table-cell_right"><?= $order->postcode;?>,</br><?= $order->address;?></td>
                        </tr>
                        <?php endif?>
                        </tbody>
                    </table>
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