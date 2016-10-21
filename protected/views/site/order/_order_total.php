<div class="cart-total__price cart-total__price_subtotal">
    <span class="cart-total__price-title">Подитог</span>
    <span class="cart-subtotal-val"><?= $model->subtotal ?> руб.</span>
</div>
<?php if($model->sale > 0) :?>
    <div class="cart-total__price cart-total__price_discount">
        <span class="cart-total__price-title">Скидка</span>
        <span class="cart-sale-val">- <?= $model->sale ?> руб.</span>
    </div>
<?php endif; ?>
<div class="cart-total__price cart-total__price_amount">
        <span class="cart-total__price-title">Доставка
            <span class="cart-total__price-hint i_help hint-wrap">
                <div class="hint">При заказе от <?= Yii::app()->params['shippingFreeCountString']?> позиций — доставка бесплатно
                </div>
            </span>
        </span>
    <span class="cart-shipping-val">
        <?php if(isset($shipping)) :?><?=$shipping?> руб.<?php else: ?>Не определена<?php endif; ?>
    </span>
</div>
<div class="cart-total__price cart-total__price_total">
    <span class="cart-total__price-title">Итого</span>
    <div class="cart-total-val">
        <span><?php if(isset($shipping)) :?><?=$model->total+$shipping?><?php else: ?><?= $model->total ?><?php endif; ?></span> руб.
    </div>
</div>