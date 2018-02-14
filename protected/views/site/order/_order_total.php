
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