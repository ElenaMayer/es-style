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
        <?php echo $form->textFieldGroup($user, 'surname', array('placeholder'=>'')); ?>
    </div>
    <div class="row">
        <?php echo $form->textFieldGroup($user, 'name', array('placeholder'=>'')); ?>
    </div>
    <div class="row">
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
    <div class="row">
        <div class="payment">
<!--            --><?php //echo $form->radioButtonList($user, 'payment', $user->blocked ? ['online'  => 'Онлайн-оплата']: Yii::app()->params['paymentMethod']); ?>
            <input id="ytUser_payment" type="hidden" value="" name="User[payment]">
            <span id="User_payment">
                <input id="User_payment_0" value="online" checked="checked" type="radio" name="User[payment]">
                <label for="User_payment_0">Онлайн-оплата</label>
                <i class="payment_method"></i>
                <?php if (!$user->blocked):?>
                    <input class="payment_cod" id="User_payment_1" value="cod" type="radio" name="User[payment]">
                    <label class="payment_cod" for="User_payment_1">При получении (взимается комиссия за наложенный платеж)</label>
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
</script>