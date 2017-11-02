<div class="cart-total__price cart-total__price_subtotal">
    <span class="cart-total__price-title">Подитог</span>
    <span class="cart-subtotal-val"><?= $model->subtotal ?> руб.</span>
</div>
<div class="cart-total__price cart-total__price_amount">
        <span class="cart-total__price-title">Доставка<?php if(Cart::isWholesale()):?> до ТК<?php endif; ?>
            <span class="cart-total__price-hint i_help hint-wrap">
                <?php if(!Yii::app()->user->isGuest && Yii::app()->user->is_wholesaler):?>
                    <div class="hint">Доставка до ТК бесплатно, услуги ТК оплачиваются при получении</div>
                <?php else:?>
                    <div class="hint">При заказе от <?= Yii::app()->params['shippingFreeCountString']?> позиций — доставка бесплатно</div>
                <?php endif;?>            </span>
        </span>
    <span class="cart-shipping-val">
        <?= $model->shipping ?> руб.
    </span>
</div>
<?php if($model->sale > 0) :?>
    <div class="cart-total__price cart-total__price_discount">
        <span class="cart-total__price-title">Скидка</span>
        <span class="cart-sale-val">- <?= $model->sale ?> руб.</span>
    </div>
<?php endif; ?>
<?php if($model->coupon_id) :?>
    <div class="cart-total__price cart-total__price_discount">
        <span class="cart-total__price-title">Скидка по купону</span>
        <span class="cart-sale-val">- <?= $model->coupon_sale ? $model->coupon_sale : 0 ?> руб.</span>
    </div>
<?php endif; ?>
<div class="cart-total__price cart-total__price_total">
    <span class="cart-total__price-title">Итого</span>
    <span class="cart-total-val"><?= $model->total ?> руб.</span>
</div>