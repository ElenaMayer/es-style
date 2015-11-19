<div class="new-order">
    <div class="order-form">
        <?php $this->renderPartial('_order_form', array('user'=>$user)); ?>
    </div>
    <div class="cart-separator"></div>
    <div class="cart-total cart-total_threshold">
        <?php $this->renderPartial('cart/_cart_total', array('model'=>$cart)); ?>
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
</div>
<script>
    cart_id = <?= $cart->id ?>;
    $( "body" ).on("mouseover", ".i_help", function() {$(this).children('.hint').addClass('hint-show')});
    $( "body" ).on("mouseleave", ".i_help", function() {$(this).children('.hint').removeClass('hint-show')});

    $( 'body' ).on( 'click', '.order_submit', function() {
        $.ajax({
            url: "/order/" + cart_id,
            data: $( "#order-form" ).serialize(),
            type: "POST",
            dataType: "html",
            success: function (data) {
                if (data == 'in_progress') {
                    window.location = "ok";
                } else if(data == 'payment'){
                    window.location = "/payment";
                } else {
                    $('.order-form').html(data);
                }
            }
        })
    });
    $( 'body' ).on( 'change', '#create_profile', function() {
        console.log($(this).prop('checked'));
        if($(this).prop('checked'))
            $('.order-password').show();
        else
            $('.order-password').hide();
    });
</script>