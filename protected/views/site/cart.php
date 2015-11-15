<?php if(!empty($model->cartItems)) :?>
    <div class="cart-list">
        <div class="cart-list__head">
            <div class="cart-item__cell cart-item__cell_description">Товар</div>
            <div class="cart-item__cell cart-item__cell_price">Стоимость</div>
            <div class="cart-item__cell cart-item__cell_quantity">Кол-во</div>
            <div class="cart-item__cell cart-item__cell_total">Итого</div>
        </div>
        <ul class="cart-list__content">
            <?php foreach($model->cartItems as $cartItem) :?>
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
            <?php endforeach; ?>
        </ul>
        <div class="cart-footer"></div>
        <div class="cart-total cart-total_threshold">
            <div class="cart-total__price cart-total__price_subtotal">
                <span class="cart-total__price-title">Подытог</span>
                <span class="cart-total__price-val"><?= $model->subtotal ?> руб.</span>
            </div><div class="cart-total__price cart-total__price_amount">
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
        </div>
        <div class="cart-separator"></div>
        <div class="cart-navigation">
            <a href="" class="button button_blue button_big cart-navigation__order">
                <span class="button__title">Отправить заказ</span>
                <span class="button__progress"></span>
            </a>
        </div>
        <div class="cart-separator"></div>
    </div>
<?php else :?>
    <div class="cart_empty"><h2 class="h2">В корзину ничего не добавлено</h2></div>
<?php endif; ?>

<script>
    $( ".i_help" ).hover(
        function() {
            $(this).children('.hint').addClass('hint-show');
        },
        function() {
            $(this).children('.hint').removeClass('hint-show');
        }
    );
    $( "body" ).on("click", ".change-quantity", function() {
        if (!$(this).hasClass("button_disabled")) {
            item_id = $(this).parent().data("item-id");
            max_count = <?= Yii::app()->params['maxItemCountInCart']?>;
            if ($(this).hasClass('change-quantity_increase'))
                action_name = "increase";
            else
                action_name = "decrease";
            $(this).parent().children('.change-quantity_decrease').addClass('button_in-progress').addClass('button_disabled');
            $(this).parent().children('.change-quantity_increase').addClass('button_in-progress').addClass('button_disabled');
            $.ajax({
                url: "/ajax/changeCount",
                data: {
                    item_id: item_id,
                    action_name: action_name
                },
                type: "POST",
                dataType: "html",
                success: function (data) {
                    e = $('#cart_item_' + item_id)
                    if (data > 0) {
                        e.find('.cart-item__quantity').html(data);
                        e.find('.button_disabled').removeClass('button_disabled');
                        if(data == 1)
                            e.find('.change-quantity_decrease').addClass('button_disabled');
                        else if(data == max_count)
                            e.find('.change-quantity_increase').addClass('button_disabled');
                    }
                    e.find('.change-quantity_decrease').removeClass('button_in-progress');
                    e.find('.change-quantity_increase').removeClass('button_in-progress');
                }
            });
        }
    });
    $( "body" ).on("click", "button.remove", function() {
        if (!$(this).hasClass("button_disabled")) {
            item_id = $(this).data("item-id");
            $(this).addClass('button_in-progress').addClass('button_disabled');
            $.ajax({
                url: "/ajax/deleteItemFromCart",
                data: {
                    item_id: item_id
                },
                type: "POST",
                dataType: "html",
                success: function (data) {
                    e = $('#cart_item_' + item_id)
                    if (data) {
                        e.hide('slow');
                    }
                    e.find('button.remove').removeClass('button_in-progress').removeClass('button_disabled');
                }
            });
        }
    });
    $( ".cart-item" ).hover(
        function() {
            $(this).find('.change-quantity_decrease').show();
            $(this).find('.change-quantity_increase').show();
            $(this).find('.button_icon.remove').show();
        },
        function() {
            $(this).find('.change-quantity_decrease').hide();
            $(this).find('.change-quantity_increase').hide();
            $(this).find('.button_icon.remove').hide();
        }
    );
</script>