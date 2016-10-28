<?php if($model->sale > 0 || $model->coupon_id) :?>
    <div class="cart-total__price cart-total__price_subtotal">
        <span class="cart-total__price-title">Подитог</span>
        <span class="cart-subtotal-val"><?= $model->subtotal ?> руб.</span>
    </div>
<?php endif; ?>
<?php if($model->sale > 0) :?>
    <div class="cart-total__price cart-total__price_discount">
        <span class="cart-total__price-title">Скидка</span>
        <span class="cart-sale-val">- <?= $model->sale ?> руб.</span>
    </div>
<?php endif; ?>
<?php if($model->coupon_id) :?>
    <div class="cart-total__price cart-total__price_discount">
        <span class="cart-total__price-title">Скидка по купону</span>
        <span class="cart-sale-val">- <?= $model->coupon_sale ?> руб.</span>
    </div>
<?php endif; ?>
<div class="cart-total__price cart-total__price_total">
    <span class="cart-total__price-title">Итого</span>
    <span class="cart-total-val"><?= $model->total ?> руб.</span>
</div>