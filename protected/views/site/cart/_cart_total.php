<div class="col-md-6 col-sm-12 col-xs-12 smt-40 xmt-40">
    <div class="htc__cart__total">
        <h6>Итого</h6>
        <div class="cart__desk__list">
            <ul class="cart__desc">
                <li>Подитог</li>
                <?php if($model->sale > 0 || $model->subtotal >= Yii::app()->params['wh_sum']) :?><li>Скидка</li><?php endif; ?>
                <?php if($model->coupon_id) :?><li>Купон</li><?php endif; ?>
                <li>Доставка</li>
            </ul>
            <ul class="cart__price">
                <li><?= $model->subtotal ?>₽</li>
                <?php if($model->sale > 0) :?>
                    <li>- <?= $model->sale ?>₽</li>
                <?php elseif ($model->subtotal >= Yii::app()->params['wh_sum']):?>
                    <li>- <?= $model->subtotal*(Yii::app()->params['wh_sale'])/100 ?>₽</li>
                <?php endif; ?>
                <?php if($model->coupon_id) :?><li>- <?= $model->coupon_sale ? $model->coupon_sale : 0 ?>₽</li><?php endif; ?>
                <?php if($model->subtotal < Yii::app()->params['wh_sum']) :?>
                    <li><?= $model->shipping ?>₽</li>
                <?php else:?>
                    <li>Расчет доставки после оформления заказа</li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="cart__total">
            <span>Итого</span>
            <span>
                <?php if($model->subtotal < Yii::app()->params['wh_sum']) :?>
                    <?= $model->total ?>₽
                <?php else:?>
                    <?= $model->subtotal*(100-Yii::app()->params['wh_sale'])/100 ?>₽
                <?php endif; ?>
            </span>
        </div>
        <ul class="payment__btn">
            <li class="active">
                <a <?php if($model->isReadyToOrder()):?>href="/order"<?php endif;?> <?php if(!$model->isReadyToOrder()):?>class="button_disabled" <?php endif;?>>Оформить заказ</a>
            </li>
            <li><a href="/dress">Продолжить покупки</a></li>
        </ul>
    </div>
</div>