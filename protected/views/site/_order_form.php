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
        <div class="form-group">
            <?php if (Yii::app()->user->isGuest):?>
                <?php echo $form->textField($user, 'email', array( 'class' => 'form-control')); ?>
            <?php else :?>
                <?php echo $form->textField($user, 'email', array('disabled'=>"disabled", 'class' => 'form-control')); ?>
            <?php endif ?>
            <?php echo $form->labelEx($user,'email'); ?>
        </div>
    </div>
    <?php if (Yii::app()->user->isGuest):?>
        <div class="row">
            <div class="form-group">
                <div class="order-auth-checkout__register">
                    <?php echo CHtml::checkBox('create_profile', false, ['value'=>'1']); ?>
                    <?php echo CHtml::label('Зарегистрироваться для упрощения покупки', 'create_profile'); ?>
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
    </div>
    <div class="row">
        <div class="form-group address">
            <?php echo $form->labelEx($user,'address'); ?>
            <?php echo $form->textField($user, 'address', array('placeholder'=>'', 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="row">
        <div class="payment">
            <?php echo CHtml::radioButtonList('payment', 'cod', ['cod'=>'При получении на почте', 'card'=>'Онлайн-оплата картой']);?>
        </div>
        <?php echo CHtml::label('Способ оплаты', 'payment'); ?>
    </div>
<?php $this->endWidget(); ?>