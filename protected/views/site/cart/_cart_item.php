<tr id="cart_main_item_<?= $cartItem->id; ?>">
    <td class="product-thumbnail">
        <a href="/<?= $cartItem->photo->category ?>/<?= $cartItem->photo->article ?>">
            <img src="<?= $cartItem->photo->getPreviewUrl(); ?>" alt="<?= $cartItem->photo->title ?>" />
        </a>
    </td>
    <td class="product-name">
        <a href="/<?= $cartItem->photo->category ?>/<?= $cartItem->photo->article ?>"><?= $cartItem->photo->title ?></a>
    </td>

    <td class="product-size">
        <?php if($cartItem->size) :?>
            <div class="cart-item__size"><?= $cartItem->size?></div>
        <?php else :?>
            <div class="cart-item__size"><?= $cartItem->photo->size_at ?>-<?= $cartItem->photo->size_to ?></div>
        <?php endif; ?>
    </td>
    <td class="product-price">
        <?php if(Cart::isWholesale()) :?>
            <div class="cart-item__cell cart-item__cell_price"><?= $cartItem->photo->wholesale_price?>₽
        <?php elseif($cartItem->cart->coupon_id && ($newPrice = $cartItem->cart->coupon->getSumWithSaleInRub($cartItem->photo->price, $cartItem->photo->category)) && $cartItem->photo->price!=$newPrice) :?>
            <div class="cart-item__cell cart-item__cell_price"><?= $newPrice ?>₽
            <?php if($cartItem->photo->is_sale) :?>
                <del><div class="cart-item__old-price"><?= $cartItem->photo->old_price?>₽</div></del>
            <?php else :?>
                <div class="cart-item__old-price"><?= $cartItem->photo->price ?>₽</div>
            <?php endif; ?>
        <?php elseif($cartItem->photo->is_sale) :?>
            <div class="cart-item__cell cart-item__cell_price"><?= $cartItem->photo->price?>₽
            <del><div class="cart-item__old-price"><?= $cartItem->photo->old_price?>₽</div></del>
        <?php else :?>
            <div class="cart-item__cell cart-item__cell_price"><?= $cartItem->photo->price?>₽
        <?php endif; ?>
    </td>
    <td class="product-quantity">
        <div class="cart-item__cell cart-item__cell_quantity" data-item-id="<?= $cartItem->id; ?>">
            <?php if($cartItem->photo->is_available) :?>
                <button class="button<?php if($cartItem->count==1):?> button_disabled<?php endif; ?> change-quantity change-quantity_decrease">
                    <span class="button__progress"></span>
                    <i class="icon-minus icons"></i>
                </button>
                <span class="cart-item__quantity"><?= $cartItem->count ?></span>
                <button class="button<?php if($cartItem->count== Yii::app()->params['maxItemCountInCart']) :?> button_disabled<?php endif; ?> change-quantity change-quantity_increase">
                    <span class="button__progress"></span>
                    <i class="icon-plus icons"></i>
                </button>
            <?php endif; ?>
        </div>
    </td>
    <td class="product-subtotal"><?php if($cartItem->photo->is_available) :?><?= $cartItem->getSum()?><?php else :?>0<?php endif; ?>₽</td>
    <td class="product-remove">
        <button class="button button_icon remove" data-item-id="<?= $cartItem->id; ?>">
            <span class="button__title"><i class="icon-trash icons"></i></span>
        </button>
    </td>
</tr>