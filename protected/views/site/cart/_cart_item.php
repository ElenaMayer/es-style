<li id="cart_item_<?= $cartItem->id; ?>" class="cart-item<?php if(!$cartItem->photo->is_available) :?> cart-item_out<?php endif; ?>">
    <a href="/<?= $cartItem->photo->category ?>/<?= $cartItem->photo->article ?>" class="cart-item__cell cart-item__cell_photo">
        <img src="<?= $cartItem->photo->getPreviewUrl(); ?>" class="cart-item__photo">
    </a>
    <div class="cart-item__cell cart-item__cell_description">
        <div class="cart-item__name"><?= $cartItem->photo->title ?> арт. <?= $cartItem->photo->article ?></div>
        <?php if($cartItem->size) :?>
            <div class="cart-item__size">Размер: <?= $cartItem->size?></div>
        <?php else :?>
            <div class="cart-item__size">Универсальный размер: <?= $cartItem->photo->size_at ?>-<?= $cartItem->photo->size_to ?></div>
        <?php endif; ?>
        <?php if(!$cartItem->photo->is_available) :?>
            <div class="cart-item__extra-info">
                <span class="product-stock product-stock_wrapper">нет в наличии</span>
            </div>
        <?php endif; ?>
    </div>
    <?php if($cartItem->photo->new_price) :?>
    <div class="cart-item__cell cart-item__cell_price"><?= $cartItem->photo->new_price?>&nbsp;руб.
        <div class="cart-item__old-price"><?= $cartItem->photo->price?>&nbsp;руб.</div>
        <?php else :?>
        <div class="cart-item__cell cart-item__cell_price"><?= $cartItem->photo->price?>&nbsp;руб.
            <?php endif; ?>
        </div>
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
        <div class="cart-item__cell cart-item__cell_total"><?php if($cartItem->photo->is_available) :?><?= $cartItem->getSum()?><?php else :?>0<?php endif; ?>&nbsp;руб.</div>
</li>