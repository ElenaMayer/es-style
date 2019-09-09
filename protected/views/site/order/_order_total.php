
<div class="order-details__count">
    <div class="order-details__count__single">
        <h5>Подитог</h5>
        <span class="price"><?= $cart->subtotal ?>₽</span>
    </div>
    <?php if($cart->sale > 0 || $cart->subtotal >= Yii::app()->params['wh_sum']) :?>
        <div class="order-details__count__single">
            <h5>Скидка</h5>
            <?php if($cart->sale > 0) :?>
                <span class="price">- <?= $cart->sale ?>₽</span>
            <?php elseif ($cart->subtotal >= Yii::app()->params['wh_sum']):?>
                <span class="price">- <?= $cart->subtotal*(Yii::app()->params['wh_sale'])/100 ?>₽</span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if($cart->coupon_id) :?>
        <div class="order-details__count__single">
            <h5>Купон</h5>
            <span class="price">- <?= $cart->coupon_sale ? $cart->coupon_sale : 0 ?>₽</span>
        </div>
    <?php endif; ?>
    <div class="order-details__count__single">
        <h5>Доставка</h5>
        <?php if($cart->subtotal < Yii::app()->params['wh_sum']) :?>
            <span class="price"><?= $cart->shipping ?>₽</span>
        <?php else:?>
            <span class="price">Расчет доставки после оформления заказа</span>
        <?php endif; ?>
    </div>
</div>
<div class="ordre-details__total">
    <h5>Итого</h5>
    <?php if($cart->subtotal < Yii::app()->params['wh_sum']) :?>
        <span class="price"><?= $cart->total ?>₽</span>
    <?php else:?>
        <span class="price"><?= $cart->subtotal*(100-Yii::app()->params['wh_sale'])/100 ?>₽</span>
    <?php endif; ?>
</div>

<?php if(Cart::isWholesale() && !$cart->isReadyToOrder()) :?>
    <span class="cart_min-wholesale-sum">Минимальная оптовая партия <?=Yii::app()->params['minWholesaleSum']?>₽</span>
<?php endif;?>
<div class="buttons-cart checkout--btn dark-btn">
    <a class="button button_blue button_big order_submit <?php if(!$cart->isReadyToOrder()):?>button_disabled<?php endif;?>">
        <span class="button__title">Отправить заказ</span>
    </a>
</div>