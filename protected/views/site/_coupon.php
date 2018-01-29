<div class="cart_coupon col-md-6 col-sm-12 col-xs-12">
    <div class="ht__coupon__code">
        <span>Введите Ваш купон на скидку</span>
        <div class="coupon__box">
            <input class="coupon_field form-control" type="text" placeholder="">
            <div class="ht__cp__btn">
                <a  class="coupon_use_link button button_big button_corner-left">Применить</a>
            </div>
        </div>
        <div class="help-block error hide">Это поле необходимо заполнить.</div>
    </div>
</div>

<script>
    action = '<?php echo Yii::app()->controller->action->id ?>';
    $( "body" ).on("click", ".coupon_use_link", function() {
        if (!$(this).hasClass("button_disabled")) {
            if ($('.coupon_field').val().length > 0) {

                var data = {
                    coupon: $('.coupon_field').val(),
                    action: action
                }
                if (typeof shipping_cost !== "undefined")
                    data['shipping_cost'] = shipping_cost;

                $(this).addClass('button_in-progress').addClass('button_disabled');
                $('.cart_coupon .help-block').addClass('hide');
                $.ajax({
                    url: "/ajax/addCouponToCart",
                    data: data,
                    type: "POST",
                    dataType: "html",
                    success: function (data) {
                        $('.coupon_use_link').removeClass('button_in-progress').removeClass('button_disabled');
                        var is_json = true;
                        try {
                            var json = $.parseJSON(data);
                        } catch(err) {
                            is_json = false;
                        }
                        if (is_json) {
                            $('.cart_coupon .help-block').text(json['error']);
                            $('.cart_coupon .help-block').removeClass('hide');
                        } else {
                            if (action == 'order') {
                                shipping = $('.cart-shipping-val').text();
                                $('.cart-total').html(data);
                                $('.cart-shipping-val').text(shipping);
                            } else if (action == 'cart')
                                $('.content').html(data);
                            $('.coupon_field').val('');
                        }
                    },
                    error: function () {
                        $('.coupon_use_link').removeClass('button_in-progress').removeClass('button_disabled');
                    }
                });
            } else {
                $('.cart_coupon .help-block').text('Введите кодовое слово');
                $('.cart_coupon .help-block').removeClass('hide');
            }
        }
    });
</script>