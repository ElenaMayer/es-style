<?php if(!empty($cartItem)) :?>
    <?php $this->beginWidget(
        'booster.widgets.TbModal',
        array('id' => 'add_to_cart')
    ); ?>
        <div class="modal-body">
            <a class="close" data-dismiss="modal">&times;</a>
            <div class="post-cart-add__header">
                <div class="h2 post-cart-add__title">Товар добавлен в корзину</div>
                <div class="post-cart-add__cart-info">Всего в вашей корзине <?= $cartItem->cart->count ?> товара.
                    <a class="link post-cart-add__view-cart" href="/cart/">Просмотреть</a>
                </div>
            </div>
            <div class="post-cart-add__cart js-popup__adapt-height">
                <div class="cart-item cart-item_added">
                    <?php $this->renderPartial('../site/cart/_cart_item_base', array('cartItem'=>$cartItem)); ?>
                </div>
            </div>
            <div class="post-cart-add__footer">
                <span class="link post-cart-add__close" data-dismiss="modal">Продолжить покупки</span>
                <a class="button button_blue button_big post-cart-add__basket" href="/order/<?= $cartItem->cart->id ?>">
                    <span class="button__title">Оформить заказ</span>
                </a>
            </div>
        </div>
    <?php $this->endWidget(); ?>
<?php endif; ?>