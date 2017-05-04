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

    <div class="row">
        <div class="form-group fio_group">
            <div class="fio">
                <?php echo $form->textField($user, 'surname', array( 'class' => 'form-control', 'placeholder'=>'Фамилия')); ?>
                <?php echo $form->textField($user, 'name', array( 'class' => 'form-control', 'placeholder'=>'Имя *')); ?>
                <?php echo $form->textField($user, 'middlename', array( 'class' => 'form-control', 'placeholder'=>'Отчество')); ?>
            </div>
            <?php echo $form->labelEx($user, 'fio'); ?>
            <?php if (isset($user->getErrors()['name'])):?>
                <div class="help-block error"><?= array_shift($user->getErrors()['name']) ?></div>
            <?php endif ?>
        </div>
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
            <?php if (isset($user->getErrors()['email'])):?>
                <div class="help-block error"><?= array_shift($user->getErrors()['email']) ?></div>
            <?php endif ?>
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
    <div class="row shipping_method">
        <?php echo $form->dropDownList($user,'shipping_method', ['russian_post'=>'Почта России', 'store'=>'Получение в магазине (для Новосибирска)'], array('class' => 'form-control')); ?>
        <?php echo $form->labelEx($user,'shipping_method'); ?>
    </div>
    <div class="shipping_data">
        <h4>Данные для доставки</h4>
        <div class="row">
            <?php echo $form->textFieldGroup($user, 'postcode', array('placeholder'=>'630000')); ?>
            <?php echo $form->hiddenField($user, 'postcode_error'); ?>
            <?php echo $form->hiddenField($user, 'shipping', ['value'=> ($model->count < Yii::app()->params['shippingFreeCountString'] && $user->shipping_method != 'store') ? Yii::app()->params['defaultShippingTariff'] : 0]); ?>
        </div>
        <div class="row big-row">
            <div class="form-group address">
                <?php echo $form->labelEx($user,'address'); ?>
                <?php echo $form->textFieldGroup($user, 'address', array('placeholder'=>'г.Новосибирск ул.Ленина д.1 кв.1', 'class' => 'form-control')); ?>
            </div>
        </div>
    </div>
    <div class="after_shipping"></div>
    <div class="row payment">
        <?php echo $form->dropDownList($user,'payment', ['cod'=>'При получении', 'online'=>'Онлайн-оплата'], array('class' => 'form-control')); ?>
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
    $( 'body' ).on( 'change', '#User_shipping_method', function() {
        if($(this).find(":selected").val() == 'russian_post') {
            shipping_by_post();
        } else {
            shipping_to_store();
        }
    });
    function shipping_by_post() {
        $('.shipping_data').show();
        change_shipping_to_old_value();
    }
    function shipping_to_store() {
        $('.shipping_data').hide();
        change_shipping_to_zero();
    }

    function change_shipping_to_old_value() {
        old_shipping = parseInt($("#User_shipping").val());
        if(!isNaN(old_shipping) && old_shipping > 0) {
            new_total = parseInt($('.cart-total-val').children('span').text()) + old_shipping;
            $('.cart-total-val').children('span').text(new_total.toFixed(0));
            $('.cart-shipping-val').text(old_shipping + " руб.");
        }
    }
    function change_shipping_to_zero() {
        old_shipping = parseInt($("#User_shipping").val());
        if (old_shipping > 0){
            new_total = parseInt($('.cart-total-val').children('span').text()) - old_shipping;
            $('.cart-total-val').children('span').text(new_total.toFixed(0));
        }
        $('.cart-shipping-val').text("0 руб.");
    }

</script>