<li id="cart_item_<?= $cartItem->id; ?>" class="cart-item<?php if(!$cartItem->photo->is_available) :?> cart-item_out<?php endif; ?>">
    <?php $this->renderPartial($path.'cart/_cart_item_base', array('cartItem'=>$cartItem)); ?>
    <div class="cart-item__cell cart-item__cell_quantity" data-item-id="<?= $cartItem->id; ?>">
        <?php if($cartItem->photo->is_available) :?>
            <button class="button<?php if($cartItem->count==1):?> button_disabled<?php endif; ?> change-quantity change-quantity_decrease">
                <span class="button__progress"></span>
                <i class="button__icon"></i>
            </button>
            <span class="cart-item__quantity"><?= $cartItem->count ?></span>
            <button class="button<?php if($cartItem->count== Yii::app()->params['maxItemCountInCart']) :?> button_disabled<?php endif; ?> change-quantity change-quantity_increase">
                <span class="button__progress"></span>
                <i class="button__icon"></i>
            </button>
        <?php endif; ?>
    </div>
    <button class="button button_icon remove" data-item-id="<?= $cartItem->id; ?>">
        <span class="button__progress"></span>
        <span class="button__title"><i class="button__icon"></i>Убрать из корзины</span>
    </button>
    <div class="cart-item__cell cart-item__cell_total">
        <?php if($cartItem->photo->is_available) :?><?= $cartItem->getSum()?><?php else :?>0<?php endif; ?>&nbsp;руб.
    </div>
</li>