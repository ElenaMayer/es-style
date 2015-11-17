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
                <?php $this->renderPartial('cart/_cart_item', array('cartItem'=>$cartItem)); ?>
            <?php endforeach; ?>
        </ul>
        <div class="cart-separator"></div>
        <div class="cart-total cart-total_threshold">
            <?php $this->renderPartial('cart/_cart_total', array('model'=>$model)); ?>
        </div>
        <div class="cart-separator"></div>
        <div class="cart-navigation">
            <a href="/order/<?= $model->id?>" class="button button_blue button_big cart-navigation__order">
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
    $( "body" ).on("mouseover", ".i_help", function() {$(this).children('.hint').addClass('hint-show')}),
    $( "body" ).on("mouseleave", ".i_help", function() {$(this).children('.hint').removeClass('hint-show')});
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
                        $('.cart-total').html(data);
                    } else {
                        e.find('button.remove').removeClass('button_in-progress').removeClass('button_disabled');
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