<div class="lc">
    <?php $this->renderPartial('user/_user_menu'); ?>
    <div class="history table__column table__column_right">
        <div class="table__cell">
            <header class="account-header">
                <h1 class="account-header__title">
                    <a href="/sales/order/history/">Мои заказы</a>
                </h1>
                <h3 class="account-header__subtitle">№ RU150830-060577 от 30.08.2015</h3>
                <button class="account-header__button refund__button button">
                    <span class="button__title">Оформить возврат</span>
                </button>
            </header>
            <dl class="order-data">
                <dt class="order-data__label">Статус</dt>
                <dd class="order-data__value">Заказ доставлен&nbsp;</dd>
                <dt class="order-data__label">Сумма</dt>
                <dd class="order-data__value">
                    <table class="order-data__table">
                        <tbody>
                        <tr class="order-data__table-row">
                            <td class="order-data__table-cell">Подытог</td>
                            <td class="order-data__table-cell order-data__table-cell_right">23 232&nbsp;руб.</td>
                        </tr><tr class="order-data__table-row">
                            <td class="order-data__table-cell">Скидка</td>
                            <td class="order-data__table-cell order-data__table-cell_right">2 963&nbsp;руб.</td>
                        </tr><tr class="order-data__table-row">
                            <td class="order-data__table-cell">Доставка</td>
                            <td class="order-data__table-cell order-data__table-cell_right">299&nbsp;руб.</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr class="order-data__table-row order-data__table-row_amount">
                            <td class="order-data__table-cell">Итого, включая НДС 18%</td>
                            <td class="order-data__table-cell order-data__table-cell_right">20 568&nbsp;руб.</td>
                        </tr>
                        </tfoot>
                    </table>&nbsp;
                </dd>
                <dt class="order-data__label">Метод оплаты</dt>
                <dd class="order-data__value">Наличными/банковской картой курьеру&nbsp;</dd>
                <dt class="order-data__label">Доставка</dt>
                <dd class="order-data__value">
                    <div class="order-data__value-row">Курьерская доставка</div>
                    <div class="order-data__value-row">Ожидаемый срок доставки — 10:00-13:00 2015-09-04</div>
                    <table class="order-data__table order-data__table_top-margin">
                        <tbody>
                        <tr class="order-data__table-row">
                            <td class="order-data__table-cell">Адрес</td>
                            <td class="order-data__table-cell order-data__table-cell_right">Россия, Новосибирская, Новосибирск, 630001,<br>Ельцовская, д.39</td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="order-data__table order-data__table_top-margin">
                        <tbody>
                        <tr class="order-data__table-row">
                            <td class="order-data__table-cell">Получатель</td>
                            <td class="order-data__table-cell order-data__table-cell_right">Елена Майер</td>
                        </tr>
                        <tr class="order-data__table-row">
                            <td class="order-data__table-cell">Телефон</td>
                            <td class="order-data__table-cell order-data__table-cell_right">+79139027868</td>
                        </tr>
                        </tbody>
                    </table>&nbsp;
                </dd>
            </dl>
            <?php foreach($order->cartItems as $cartItem) :?>
                <?php $this->renderPartial('cart/_cart_item_base', array('cartItem'=>$cartItem)); ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>