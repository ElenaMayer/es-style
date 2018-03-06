<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(/data/images/bg/order.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="/">Главная</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Оформление заказа</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="order-form">
                    <?php $this->renderPartial('order/_order_form', array('user'=>$user, 'model'=>$cart)); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Ваш заказ</h5>
                    <div class="order-details__item">
                        <?php foreach($cart->cartItems as $cartItem) :?>
                            <div id="order_item_<?= $cartItem->id; ?>" class="single-item">
                                <div class="single-item__thumb">
                                    <img src="<?= $cartItem->photo->getPreviewUrl(); ?>" alt="<?= $cartItem->photo->title ?>">
                                </div>
                                <div class="single-item__content">
                                    <a href="/<?= $cartItem->photo->category ?>/<?= $cartItem->photo->article ?>"><?= $cartItem->photo->title ?></a>
                                    <span class="size">Размер:
                                        <?php if($cartItem->size) :?>
                                            <div class="cart-item__size"><?= $cartItem->size?></div>
                                        <?php else :?>
                                            <div class="cart-item__size"><?= $cartItem->photo->size_at ?>-<?= $cartItem->photo->size_to ?></div>
                                        <?php endif; ?>
                                    </span>
                                    <span class="quantity">Кол.: <?= $cartItem->count ?></span>
                                    <?php if(Cart::isWholesale()) :?>
                                        <span class="price"><?= $cartItem->photo->wholesale_price?>₽</span>
                                    <?php elseif($cartItem->cart->coupon_id && ($newPrice = $cartItem->cart->coupon->getSumWithSaleInRub($cartItem->photo->price, $cartItem->photo->category)) && $cartItem->photo->price!=$newPrice) :?>
                                        <span class="price"><?= $newPrice ?>₽</span>
                                    <?php else :?>
                                        <span class="price"><?= $cartItem->photo->price?>₽</span>
                                    <?php endif; ?>
                                </div>
                                <div class="single-item__remove">
                                    <button class="button button_icon remove" data-item-id="<?= $cartItem->id; ?>">
                                        <span class="button__title"><i class="zmdi zmdi-delete"></i></span>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="order-total">
                        <?php $this->renderPartial('order/_order_total', array('cart'=>$cart)); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="order_created">
    <?php $this->renderPartial('order/_order_created', array('orderId'=>null)); ?>
</div>

<!-- cart-main-area end -->
<script>
    $( document ).ready(function() {
        ga('send', 'event', 'order', 'begin_order');
    });
    cart_id = <?= $cart->id ?>;
    $( "body" ).on("mouseover", ".i_help", function() {$(this).children('.hint').addClass('hint-show')});
    $( "body" ).on("mouseleave", ".i_help", function() {$(this).children('.hint').removeClass('hint-show')});

    $( "body" ).on("click", "button.remove", function() {
        if (!$(this).hasClass("button_disabled")) {
            item_id = $(this).data("item-id");
            $(this).addClass('button_in-progress').addClass('button_disabled');
            $.ajax({
                url: "/ajax/deleteItemFromOrder",
                data: {
                    item_id: item_id
                },
                type: "POST",
                dataType: "html",
                success: function (data) {
                    e = $('#cart_item_' + item_id);
                    e2 = $('#order_item_' + item_id);

                    if (data) {
                        e.hide('slow');
                        e2.hide('slow');
                        $('.order-total').html(data);
                        updateCartCount();
                    } else {
                        e2.find('button.remove').removeClass('button_in-progress').removeClass('button_disabled');
                    }
                }
            });
        }
    });

    $( 'body' ).on( 'click', '.order_submit', function() {
        yaCounter37654655.reachGoal('create_order');
        ga('send', 'event', 'order', 'create_order');
        $(this).addClass('button_in-progress').addClass('button_disabled').prop( "disabled", true );
        $.ajax({
            url: "/order",
            data: $( "#order-form" ).serialize(),
            type: "POST",
            dataType: "html",
            success: function (res) {
                $('.button_in-progress').prop( "disabled", false ).removeClass('button_disabled').removeClass('button_in-progress');
                error = false;
                try {
                    data = JSON.parse(res);
                } catch(e) {
                    error = true;
                }
                if (!error) {
                    if (data.status == 'in_progress') {
                        get_order_modal(data.orderId);
                    } else if(data.status == 'payment') {
                        window.location = data.robokassaUrl;
                    }
                } else {
                    $('.order-form').html(res);
                }
            },
            error: function () {
                $('.button_in-progress').prop( "disabled", false ).removeClass('button_disabled').removeClass('button_in-progress');
            }
        })
    });
    function get_order_modal(order_id){
        $.ajax({
            url: "/ajax/getOrderModal",
            data: {order_id: order_id},
            type: "POST",
            dataType: "html",
            success: function (data) {
                $('.order_created').html(data);
                jQuery('#order_created').modal('show');
            }
        })
    }
</script>