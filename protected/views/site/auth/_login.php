<div class="checkout-method__login accordion__body__form">
    <?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'login-form',
    'htmlOptions' => array('class' => 'login-form'),
)); ?>

    <p class="checkout-method__subtitle">Вход на сайт:</p>
    <div class="single-input">
        <?php echo $form->textFieldGroup($modelAuth, 'email', array('placeholder'=>'', 'htmlOptions'=>['class'=>'login_form'])); ?>
    </div>
    <div class="single-input">
        <?php echo $form->passwordFieldGroup($modelAuth, 'password', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
    </div>
    <a class="login-form__lost link">Забыли пароль?</a>

    <div class="dark-btn">
        <?php echo CHtml::ajaxSubmitButton('Войти',
            CHtml::normalizeUrl(array('/site/login')),
            array(
                'type' => 'POST',
                'success' => 'js: function(data) {
                                if (data == 1){
                                    window.location = window.location.pathname;
                                } else {
                                    $("#login-form").html(data);
                                    $(".button_in-progress").removeClass("button_in-progress").removeClass("button_disabled").prop( "disabled", false );
                                }
                            }',
            ),
            array(
                'class' => 'auth_button'
            )); ?>
    </div>

    <div class="checkout-method__title"><a class="login-form__register link">Зарегистрироваться</a></div>
<?php $this->endWidget(); ?>
</div>