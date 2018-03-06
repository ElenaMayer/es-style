
<div class="order-details__count">
    <div class="order-details__count__single">
        <h5>Подитог</h5>
        <span class="price"><?= $cart->subtotal ?>₽</span>
    </div>
    <?php if($cart->sale > 0) :?>
        <div class="order-details__count__single">
            <h5>Скидка</h5>
            <span class="price">- <?= $cart->sale ?>₽</span>
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
        <span class="price"><?= $cart->shipping ?>₽</span>
    </div>
</div>
<div class="ordre-details__total">
    <h5>Итого</h5>
    <span class="price"><?= $cart->total ?>₽</span>
</div>

<?php if(Cart::isWholesale() && !$cart->isReadyToOrder()) :?>
    <span class="cart_min-wholesale-sum">Минимальная оптовая партия <?=Yii::app()->params['minWholesaleSum']?>₽</span>
<?php endif;?>
<div class="buttons-cart checkout--btn dark-btn">
    <a class="button button_blue button_big order_submit <?php if(!$cart->isReadyToOrder()):?>button_disabled<?php endif;?>">
        <span class="button__title">Отправить заказ</span>
    </a>
</div>