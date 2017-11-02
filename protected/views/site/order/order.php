<div class="new-order">
    <div class="order-form">
        <?php $this->renderPartial('order/_order_form', array('user'=>$user, 'model'=>$cart)); ?>
    </div>
    <div class="cart-separator"></div>
    <div class="cart-total cart-total_threshold">
        <?php $this->renderPartial('order/_order_total', array('user'=>$user, 'model'=>$cart)); ?>
    </div>
    <div class="order-stuff">
        <div class="cart-offer">Нажимая на кнопку "Отправить заказ", вы принимаете условия <a href="/about/offer" target="_blank">Публичной оферты</a></div>
        <?php if(!Yii::app()->cart->isWholesale()) :?>
            <?php $this->renderPartial('/site/_coupon'); ?>
        <?php endif;?>
    </div>
    <div class="cart-separator"></div>
    <div class="cart-navigation">
        <a href="/cart" class="button button_big button_corner-left">
            <span class="button__title">Назад к корзине</span>
            <i class="button__corner"></i>
        </a>
        <a class="button button_blue button_big order_submit">
            <span class="button__title">Отправить заказ</span>
            <span class="button__progress"></span>
        </a>
    </div>
    <div class="clear"></div>
</div>
<div class="order_created">
    <?php $this->renderPartial('order/_order_created', array('orderId'=>null)); ?>
</div>
<script>
    $( document ).ready(function() {
        ga('send', 'event', 'order', 'begin_order');
    });
    cart_id = <?= $cart->id ?>;
    $( "body" ).on("mouseover", ".i_help", function() {$(this).children('.hint').addClass('hint-show')});
    $( "body" ).on("mouseleave", ".i_help", function() {$(this).children('.hint').removeClass('hint-show')});

    $( 'body' ).on( 'click', '.order_submit', function() {
        yaCounter37654655.reachGoal('create_order');
        ga('send', 'event', 'order', 'create_order');
        $(this).addClass('button_in-progress').addClass('button_disabled').prop( "disabled", true );
        $.ajax({
            url: "/order/" + cart_id,
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