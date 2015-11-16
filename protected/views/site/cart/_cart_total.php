<div class="cart-total__price cart-total__price_subtotal">
    <span class="cart-total__price-title">Подытог</span>
    <span class="cart-total__price-val"><?= $model->subtotal ?> руб.</span>
</div>
<div class="cart-total__price cart-total__price_amount">
        <span class="cart-total__price-title">Доставка
            <span class="cart-total__price-hint i_help hint-wrap">
                <div class="hint">При заказе от <?= Yii::app()->params['shippingFreeCountString']?> позиций — доставка бесплатно
                </div>
            </span>
        </span>
    <span class="cart-total__price-val"><?= $model->shipping ?> руб.</span>
</div>
<?php if($model->sale > 0) :?>
    <div class="cart-total__price cart-total__price_discount">
        <span class="cart-total__price-title">Скидка</span>
        <span class="cart-total__price-val">- <?= $model->sale ?> руб.</span>
    </div>
<?php endif; ?>
<div class="cart-total__price cart-total__price_total">
    <span class="cart-total__price-title">Итого</span>
    <span class="cart-total__price-val"><?= $model->total ?> руб.</span>
</div>