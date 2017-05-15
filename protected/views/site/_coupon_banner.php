<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'coupon_banner')
); ?>

<div class="modal-body">
    <div class="subscription-fast-pop">
        <h2 class="h2">У нас есть специальное предложение для вас!</h2>
        <p class="subscription-fast-title">
            <span>Скидка <?= Yii::app()->params['popup_banner_sale']?> рублей</span> на любое платье!
        </p>
        <p class="subscription-fast-text">
            Введите e-mail и купон на скидку будет выслан сразу же!
        </p>
        <form class="subscription-fast-form" method="post">
            <div class="subscription-fast-form-input">
                <label for="subscription-id">Ваш E-mail</label>
                <input id="subscription-email" name="email" value="" type="text">
                <div class="popup-email-error error"></div>
            </div>
            <span class="btn btn-simple btn-default get-coupon-button">Получить мою скидку!</span>
            <a class="close_subscription-fast-pop" data-dismiss="modal">Нет спасибо, я не люблю экономить деньги</a>
        </form>
    </div>
</div>

<?php $this->endWidget(); ?>

<script>
    $( '.content' ).on( 'click', '.get-coupon-button', function($e) {
        if(!$("#subscription-email").val()){
            $('.popup-email-error').html('Введите E-mail');
        } else if(!isEmail($("#subscription-email").val())){
            $('.popup-email-error').html('Неверный формат E-mail');
        } else {
            $(this).addClass('button_disabled').prop("disabled", true);
            $.ajax({
                url: "/ajax/sendCoupon",
                data: {
                    email: $("#subscription-email").val(),
                    action: 'catalog'
                },
                type: "POST",
                dataType: "html",
                success: function (data) {
                    if (data) {
                        $('#coupon_banner').modal('hide');
                    }
                }
            });
        }
    });
</script>
