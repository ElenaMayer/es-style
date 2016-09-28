<li class="cart-item">
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
    </div>
    <?php if($cartItem->new_price) :?>
    <div class="cart-item__cell cart-item__cell_price"><?= $cartItem->new_price?>&nbsp;руб.
        <div class="cart-item__old-price"><?= $cartItem->price?>&nbsp;руб.</div>
    <?php else :?>
        <div class="cart-item__cell cart-item__cell_price"><?= $cartItem->price?>&nbsp;руб.
    <?php endif; ?>
    </div>
    <div class="cart-item__cell cart-item__cell_quantity">
        <span class="cart-item__quantity"><?= $cartItem->count ?></span>
    </div>
    <div class="cart-item__cell cart-item__cell_total">
        <?= $cartItem->getSum() ?>&nbsp;руб.
    </div>
    <a class="delete_model" data-id="<?= $cartItem->id ?>">Удалить</a>
</li>