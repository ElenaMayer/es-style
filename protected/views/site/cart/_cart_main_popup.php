<?php if(isset(Yii::app()->cart->currentCart) && Yii::app()->cart->currentCart->count > 0):?>
    <!-- Start Cart Panel -->
    <div class="shopping__cart">
        <div class="shopping__cart__inner">
            <div class="offsetmenu__close__btn">
                <a><i class="zmdi zmdi-close"></i></a>
            </div>
            <div class="shp__cart__wrap">
                <?php foreach (Yii::app()->cart->currentCart->cartItems as $cartItem): ?>
                    <div class="shp__single__product" id="cart_item_<?= $cartItem->id?>">
                        <div class="shp__pro__thumb">
                            <a href="/<?= $cartItem->photo->category ?>/<?= $cartItem->photo->article ?>">
                                <img src="<?= $cartItem->photo->getPreviewUrl(); ?>" alt="<?= $cartItem->photo->title ?>">
                            </a>
                        </div>
                        <div class="shp__pro__details">
                            <h2><a href="/<?= $cartItem->photo->category ?>/<?= $cartItem->photo->article ?>"><?= $cartItem->photo->title ?></a></h2>

                            <span class="cart-item__size">Размер: <?= $cartItem->size?></span>
                            <?php if(!$cartItem->photo->is_available) :?>
                                <span class="">нет в наличии</span>
                            <?php else:?>
                                <span class="quantity">Кол.: <?= $cartItem->count ?></span>
                                <span class="shp__price"><?= $cartItem->getSum()?>₽</span>
                            <?php endif;?>
                        </div>
                        <div class="remove__btn">
                            <a id="<?= $cartItem->id?>" class="remove__btn_link" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>

            <?php if(Yii::app()->cart->currentCart->subtotal >= Yii::app()->params['wh_sum']):?>
                <ul class="shoping__shipping">
                    <li class="subtotal">Подитог:</li>
                    <li class="total__shipping"><?=Yii::app()->cart->currentCart->subtotal?>₽</li>
                </ul>
            <?php endif; ?>

            <?php if(Yii::app()->cart->currentCart->sale > 0) :?>
                <ul class="shoping__shipping">
                    <li class="subtotal">Скидка:</li>
                    <li class="total__shipping">- <?= Yii::app()->cart->currentCart->sale ?>₽</li>
                </ul>
            <?php elseif (Yii::app()->cart->currentCart->subtotal >= Yii::app()->params['wh_sum']):?>
                <ul class="shoping__shipping">
                    <li class="subtotal">Скидка:</li>
                    <li class="total__shipping">- <?= Yii::app()->cart->currentCart->subtotal*(Yii::app()->params['wh_sale'])/100 ?>₽</li>
                </ul>
            <?php endif; ?>

            <?php if(Yii::app()->cart->currentCart->subtotal < Yii::app()->params['wh_sum']):?>
                <ul class="shoping__shipping">
                    <li class="subtotal">Доставка:</li>
                    <li class="total__shipping"><?=Yii::app()->cart->currentCart->shipping?>₽</li>
                </ul>
            <?php endif; ?>

            <?php if(Yii::app()->cart->currentCart->subtotal < Yii::app()->params['wh_sum']):?>
                <ul class="shoping__total">
                    <li class="subtotal">Итого:</li>
                    <li class="total__price"><?=Yii::app()->cart->currentCart->total?>₽</li>
                </ul>
            <?php else:?>
                <ul class="shoping__total">
                    <li class="subtotal">Итого:</li>
                    <li class="total__price"><?=Yii::app()->cart->currentCart->subtotal*(100-Yii::app()->params['wh_sale'])/100?>₽</li>
                </ul>
            <?php endif; ?>
            <ul class="shopping__btn">
                <li><a href="/cart">В корзину</a></li>
                <li class="shp__checkout"><a href="/order">Оформить заказ</a></li>
            </ul>
        </div>
    </div>
    <!-- End Cart Panel -->
    <script>
        $( ".shp__single__product" ).on("click", ".remove__btn_link", function() {
                item_id = $(this).attr("id");
                $.ajax({
                    url: "/ajax/deleteItemFromCartPopup",
                    data: {
                        item_id: item_id
                    },
                    type: "POST",
                    dataType: "html",
                    success: function (data) {
                        e = $('#cart_item_' + item_id)
                        if (data) {
                            console.log(data);
                            e.hide('slow');
                            var d = jQuery.parseJSON(data);
                            $('.htc__qua').text(d['count']);
                            if(d['subtotal'] > 0) {
                                $('.total__price').html(d['total'] + '₽');
                                $('.total__shipping').html(d['shipping'] + '₽');
                            } else {
                                $('.total__price').html('0₽');
                                $('.total__shipping').html('0₽');
                                $('.shopping__cart').removeClass('shopping__cart__on');
                                $('.body__overlay').removeClass('is-visible');
                            }
                        }
                    }
                });
        });
    </script>
<?php endif;?>