<div class="new-order">
    <?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
        'id'=>'customer_person_data',
        'htmlOptions' => array('class' => 'order-form'),
    )); ?>
        <div class="order-auth-checkout__login">Уже зарегистрированы?
            <a href="" class="button button_blue button_big order-login">
                <span class="button__title">Войти</span>
            </a>
        </div>

        <div class="cart-separator"></div>
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
            <div class="form-group">
                <?php echo $form->textField($user, 'email', array('disabled'=>"disabled", 'class' => 'form-control')); ?>
                <?php echo $form->labelEx($user,'email'); ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="order-auth-checkout__register">
                    <?php echo CHtml::checkBox('create_profile', '0'); ?>
                    <?php echo CHtml::label('Зарегистрироваться для упрощения покупки', 'create_profile'); ?>
                </div>
            </div>
        </div>
        <div class="order-password">
            <div class="row">
                <?php echo $form->passwordFieldGroup($user, 'password', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
            </div>
            <div class="row">
                <?php echo $form->passwordFieldGroup($user, 'password2', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
            </div>
        </div>
        <h4>Данные для доставки</h4>
        <div class="row">
            <?php echo $form->textFieldGroup($user, 'postcode', array('placeholder'=>'')); ?>
        </div>
        <div class="row">
            <div class="form-group address">
                <?php echo $form->labelEx($user,'address'); ?>
                <?php echo $form->textField($user, 'address', array('placeholder'=>'', 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row">
            <div class="payment">
                <?php echo CHtml::radioButtonList('payment', false, ['cod'=>'При получении на почте', 'card'=>'Онлайн-оплата картой']);?>
            </div>
            <?php echo CHtml::label('Способ оплаты', 'payment'); ?>
        </div>
    <?php $this->endWidget(); ?>
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
        <a href="" class="button button_blue button_big cart-navigation__order">
            <span class="button__title">Отправить заказ</span>
            <span class="button__progress"></span>
        </a>
    </div>
</div>
<script>
    $( "body" ).on("mouseover", ".i_help", function() {$(this).children('.hint').addClass('hint-show')});
    $( "body" ).on("mouseleave", ".i_help", function() {$(this).children('.hint').removeClass('hint-show')});
</script>