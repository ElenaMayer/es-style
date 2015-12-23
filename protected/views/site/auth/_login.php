<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'login-form',
    'htmlOptions' => array('class' => 'login-form'),
)); ?>
    <div class="auth-popup__subtitle">Вход на сайт</div>

    <div class="row">
        <?php echo $form->textFieldGroup($modelAuth, 'email', array('placeholder'=>'', 'htmlOptions'=>['class'=>'login_form'])); ?>
    </div>
    <div class="row">
        <?php echo $form->passwordFieldGroup($modelAuth, 'password', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
        <span class="login-form__lost link">Забыли?</span>
    </div>
    <div class="form__controls">
        <span class="button button_blue">
            <?php echo CHtml::ajaxSubmitButton('Войти',
                CHtml::normalizeUrl(array('/site/login')),
                array(
                    'type' => 'POST',
                    'success' => 'js: function(data) {
                                if (data == 1)
                                    window.location = "'.substr(Yii::app()->request->requestUri, 0, strpos(Yii::app()->request->requestUri, "?")).'";
                                else {
                                    $("#login-form").html(data);
                                    $(".button_in-progress").removeClass("button_in-progress").removeClass("button_disabled").prop( "disabled", false );
                                    }
                                }',
                ),
                array(
                    'class' => 'auth_button'
                )); ?>
            <span class="button__progress"></span>
        </span>
        <span class="login-form__register link">Зарегистрироваться</span>
    </div>
<?php $this->endWidget(); ?>
