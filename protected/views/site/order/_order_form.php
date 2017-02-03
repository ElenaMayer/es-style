<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'order-form',
)); ?>
    <?php if (Yii::app()->user->isGuest):?>
        <div class="order-auth-checkout__login">Уже зарегистрированы?
            <a class="button button_blue button_big order-login" data-toggle="modal" data-target="#auth_form">
                <span class="button__title">Войти</span>
            </a>
        </div>
        <div class="cart-separator"></div>
    <?php endif ?>
    <h4>Личные данные</h4>
    <div class="row surname_field">
        <?php echo $form->textFieldGroup($user, 'surname', array('placeholder'=>'')); ?>
    </div>
    <div class="row">
        <?php echo $form->textFieldGroup($user, 'name', array('placeholder'=>'')); ?>
    </div>
    <div class="row middlename_field">
        <?php echo $form->textFieldGroup($user, 'middlename', array('placeholder'=>'')); ?>
    </div>
    <div class="row">
        <?php echo $form->textFieldGroup($user, 'phone', array('placeholder'=>'+7')); ?>
    </div>
    <div class="row">
        <div class="form-group email_group">
            <?php if (Yii::app()->user->isGuest):?>
                <?php echo $form->textField($user, 'email', array( 'class' => 'form-control', 'placeholder'=>'example@mail.ru')); ?>
            <?php else :?>
                <?php echo $form->textField($user, 'email', array('disabled'=>"disabled", 'class' => 'form-control')); ?>
            <?php endif ?>
            <?php echo $form->labelEx($user, 'email'); ?>
        </div>
    </div>
    <?php if (Yii::app()->user->isGuest):?>
        <div class="row">
            <div class="form-group">
                <div class="order-auth-checkout__register">
                    <?php echo $form->checkBox($user, 'create_profile', ['value'=>'1']); ?>
                    <?php echo $form->label($user, 'create_profile'); ?>
                </div>
            </div>
        </div>
        <div class="order-password">
            <div class="row">
                <?php echo $form->passwordFieldGroup($user, 'password1', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
            </div>
            <div class="row">
                <?php echo $form->passwordFieldGroup($user, 'password2', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
            </div>
        </div>
    <?php endif ?>

    <div class="before_shipping"></div>
    <div class="row">
        <div class="shipping_method">
            <input id="ytUser_shipping_method" type="hidden" value="" name="User[shipping_method]">
            <span id="User_shipping_method">
                <input id="User_shipping_method_0" value="russian_post" <?php if($user->shipping_method != 'store'):?>checked="checked"<?php endif;?> type="radio" name="User[shipping_method]">
                <label for="User_shipping_method_0">Почта России</label>
                <input id="User_shipping_method_1" value="store" type="radio" <?php if($user->shipping_method == 'store'):?>checked="checked"<?php endif;?> name="User[shipping_method]">
                <label for="User_shipping_method_1">Получение в магазине (для Новосибирска)</label>
            </span>
        </div>
        <?php echo $form->labelEx($user,'shipping_method'); ?>
    </div>
    <div class="shipping_data">
        <h4>Данные для доставки</h4>
        <div class="row">
            <?php echo $form->textFieldGroup($user, 'postcode', array('placeholder'=>'')); ?>
            <?php echo $form->hiddenField($user, 'postcode_error'); ?>
            <?php echo $form->hiddenField($user, 'shipping', ['value'=> isset($shipping)? $shipping : '']); ?>
        </div>
        <div class="row">
            <div class="form-group address">
                <?php echo $form->labelEx($user,'address'); ?>
                <?php echo $form->textFieldGroup($user, 'address', array('placeholder'=>'', 'class' => 'form-control')); ?>
            </div>
        </div>
    </div>
    <div class="after_shipping"></div>
    <div class="row">
        <div class="payment">
<!--            --><?php //echo $form->radioButtonList($user, 'payment', $user->blocked ? ['online'  => 'Онлайн-оплата']: Yii::app()->params['paymentMethod']); ?>
            <input id="ytUser_payment" type="hidden" value="" name="User[payment]">
            <span id="User_payment">
                <input id="User_payment_0" value="online" <?php if($user->payment == 'online'):?>checked="checked"<?php endif;?> type="radio" name="User[payment]">
                <label for="User_payment_0">Онлайн-оплата</label>
                <i class="payment_method"></i>
                <?php if (!$user->blocked):?>
                    <input class="payment_cod" id="User_payment_1" <?php if($user->payment == 'cod'):?>checked="checked"<?php endif;?> value="cod" type="radio" name="User[payment]">
                    <label class="payment_cod cod_rp" for="User_payment_1">При получении на Почте (взимается комиссия за наложенный платеж)</label>
                    <label class="payment_cod cod_s" style="display: none" for="User_payment_1">Наличными при получении в магазине</label>
                <?php endif ?>
            </span>
        </div>
        <?php echo $form->labelEx($user,'payment'); ?>
    </div>
<?php $this->endWidget(); ?>

<script>
    $(document).ready(function() {
        if($('#User_create_profile').prop('checked'))
            $('.order-password').show();
        else
            $('.email_group>label>span').hide();
        if($('#User_shipping_method_1').prop('checked'))
            shipping_to_store();
        else
            shipping_by_post();
    });
    $( 'body' ).on( 'change', '#User_create_profile', function() {
        if($(this).prop('checked')) {
            $('.order-password').show();
            $('.email_group>label>span').show();
        } else {
            $('.order-password').hide();
            $('.email_group>label>span').hide();
        }
    });
    $( 'body' ).on( 'change', '#User_shipping_method>input', function() {
        if($(this).val() == 'russian_post') {
            shipping_by_post();
        } else {
            shipping_to_store();
        }
    });
    function shipping_by_post() {
        $('.shipping_data').show();
        $('.payment_cod.cod_rp').show();
        $('.payment_cod.cod_s').hide();
        $('.surname_field span.required').show();
        $('.middlename_field span.required').show();
        change_shipping_to_old_value();
    }
    function shipping_to_store() {
        $('.shipping_data').hide();
        $('.payment_cod.cod_rp').hide();
        $('.payment_cod.cod_s').show();
        $('.surname_field span.required').hide();
        $('.middlename_field span.required').hide();
        change_shipping_to_zero();
    }

    function change_shipping_to_zero() {
        old_shipping = parseInt($("#User_shipping").val());
        if (old_shipping > 0){
            new_total = parseInt($('.cart-total-val').children('span').text()) - old_shipping;
            $('.cart-total-val').children('span').text(new_total.toFixed(0));
        }
        $('.cart-shipping-val').text("0 руб.");
    }

    function change_shipping_to_old_value() {
        old_shipping = parseInt($("#User_shipping").val());
        if(isNaN(old_shipping)) {
            $('.cart-shipping-val').text("Не определена");
        } else if (old_shipping > 0){
            new_total = parseInt($('.cart-total-val').children('span').text()) + old_shipping;
            $('.cart-total-val').children('span').text(new_total.toFixed(0));
            $('.cart-shipping-val').text(old_shipping + " руб.");
        }
    }

</script>