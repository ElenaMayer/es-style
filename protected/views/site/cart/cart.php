<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="/">Главная</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Корзина</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="cart-main-area ptb--120 bg__white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Товар</th>
                                <th class="product-name">Название</th>
                                <th class="product-size">Размер</th>
                                <th class="product-price">Цена</th>
                                <th class="product-quantity">Количество</th>
                                <th class="product-subtotal">Сумма</th>
                                <th class="product-remove">Удалить</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($model->cartItems as $cartItem) :?>
                                <?php $this->renderPartial($path.'cart/_cart_item', array('cartItem'=>$cartItem, 'path'=>$path)); ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <?php if(Cart::isWholesale() && !$model->isReadyToOrder()) :?>
                                    <span class="cart_min-wholesale-sum">Минимальная оптовая партия <?=Yii::app()->params['minWholesaleSum']?>₽</span>
                                <?php endif;?>
                                <div class="buttons-cart">
                                    <a href="/dress">Продолжить покупки</a>
                                </div>
                                <div class="buttons-cart checkout--btn">
                                    <a <?php if($model->isReadyToOrder()):?>href="/order/<?= $model->id?>"<?php endif;?> <?php if(!$model->isReadyToOrder()):?>class="button_disabled" <?php endif;?>>Оформить заказ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php if(!Cart::isWholesale()) :?>
                            <?php $this->renderPartial('/site/_coupon'); ?>
                        <?php endif;?>
                        <?php $this->renderPartial($path.'cart/_cart_total', array('model'=>$model)); ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->

<script>
    $( "body" ).on("mouseover", ".i_help", function() {$(this).children('.hint').addClass('hint-show')});
    $( "body" ).on("mouseleave", ".i_help", function() {$(this).children('.hint').removeClass('hint-show')});
    var i = 0;
    $( "body" ).on("click", ".change-quantity", function() {
        if (i < 1) {
            if (!$(this).hasClass("button_disabled")) {
                item_id = $(this).parent().data("item-id");
                max_count = <?= Yii::app()->params['maxItemCountInCart']?>;
                if ($(this).hasClass('change-quantity_increase'))
                    action_name = "increase";
                else
                    action_name = "decrease";
                $(this).parent().children('.change-quantity_decrease').addClass('button_in-progress').addClass('button_disabled').prop("disabled", true);
                i = 1;
                $.ajax({
                    url: "/ajax/changeCount",
                    data: {
                        item_id: item_id,
                        action_name: action_name
                    },
                    type: "POST",
                    dataType: "html",
                    success: function (data) {
                        $('.button_in-progress').prop("disabled", false).removeClass('button_disabled').removeClass('button_in-progress');
                        if (data) {
                            $('.content').html(data);
                            updateCartCount();
                        }
                    }
                });
            }
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
                    e = $('#cart_item_' + item_id);
                    e2 = $('#cart_main_item_' + item_id);

                    if (data) {
                        console.log(e);
                        e.hide('slow');
                        e2.hide('slow');
                        $('.cart-total').html(data);
                        updateCartCount();
                    } else {
                        e2.find('button.remove').removeClass('button_in-progress').removeClass('button_disabled');
                    }
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