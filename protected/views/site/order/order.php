<div class="new-order">
    <div class="order-form">
        <?php $this->renderPartial('order/_order_form', array('user'=>$user)); ?>
    </div>
    <div class="cart-separator"></div>
    <div class="cart-total cart-total_threshold">
        <?php $this->renderPartial('order/_order_total', array('model'=>$cart)); ?>
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
<div class="postcalc">
    Сайт использует в расчетах www.postcalc.ru
</div>
<script>
    $( document ).ready(function() {
        $(".banner").show();
        check_shipping();
    });
    cart_id = <?= $cart->id ?>;
    $( "body" ).on("mouseover", ".i_help", function() {$(this).children('.hint').addClass('hint-show')});
    $( "body" ).on("mouseleave", ".i_help", function() {$(this).children('.hint').removeClass('hint-show')});

    $( 'body' ).on( 'click', '.order_submit', function() {
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
                        window.location = "/payment";
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
    $( 'body' ).on( 'keyup', '#User_postcode', function() {
        item_count = <?= $cart->count ?>;
        if (item_count < 3) {
            if ($(this).val().length == 6) {
                get_shipping($(this).val());
            }
        }
    });
    function check_shipping() {
        item_count = <?= $cart->count ?>;
        if (item_count >= 3){
            $("#User_shipping").val(0);
            $('.cart-shipping-val').text(0 + " руб.");
        } else {
            get_shipping(parseInt($('#User_postcode').val()));
        }
    }

    total = parseInt($('.cart-total-val').children('span').text());
    
    function get_shipping(postcode_to) {
        postcalc_url = "<?=Yii::app()->params['postcalcUrl']?>";
        postcode_from = <?=Yii::app()->params['postcode']?>;
        weight = <?= $cart->weight ?>;
        url = postcalc_url + '?f=' + postcode_from + '&t=' + postcode_to +'&v=' + total +'&w=' + weight +'&o=json';
        $.ajax({
            url: url,
            type: "GET",
            dataType: 'jsonp',
            success: function (data) {
                if (data['Status'] == "OK") {
                    tariff = parseInt(data['Отправления']['ЦеннаяПосылка']['Тариф']);
                    if (tariff == 0) {
                        tariff = parseInt(data['Отправления']['ЦеннаяБандероль1Класс']['Тариф']);
                        if (tariff == 0) {
                            show_shipping_error(2);
                        } else {
                            show_shipping(tariff);
                        }
                    } else {
                        show_shipping(tariff);
                    }
                } else if(data['Status'] == "BAD_TO_INDEX"){
                    show_shipping_error(1);
                }
            }
        })
    }

    function show_shipping(tariff) {
        shipping_cost = tariff + (total + tariff) * 0.04;
        new_total = total + shipping_cost;
        $("#User_postcode_error").val(0);
        $("#User_shipping").val(shipping_cost.toFixed(0));
        $('.cart-shipping-val').text(shipping_cost.toFixed(0) + " руб.");
        $('.cart-total-val').children('span').text(new_total.toFixed(0));
    }

/*
    Error codes
    0 - Ok
    1 - Bad Index
    2 - Delivery is not possible
 */
    function show_shipping_error(error_code) {
        $("#User_postcode_error").val(error_code);
        $("#User_shipping").val(null);
        $('.cart-shipping-val').text("Не определена");
        $('.cart-total-val').children('span').text(total);
    }
</script>