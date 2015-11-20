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
<?php if($cartItem->photo->is_sale) :?>
    <div class="cart-item__cell cart-item__cell_price"><?= $cartItem->photo->new_price?>&nbsp;руб.
        <div class="cart-item__old-price"><?= $cartItem->photo->price?>&nbsp;руб.</div>
<?php else :?>
        <div class="cart-item__cell cart-item__cell_price"><?= $cartItem->photo->price?>&nbsp;руб.
<?php endif; ?>
</div>