<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'login-form',
)); ?>
    <div class="auth-popup__subtitle">Вход на сайт</div>
    <div class="row">
        <?php echo $form->textFieldGroup($modelAuth, 'email', array('placeholder'=>'', 'htmlOptions'=>['class'=>'login_form'])); ?>
    </div>
    <div class="row">
        <?php echo $form->passwordFieldGroup($modelAuth, 'password', array('placeholder'=>'')); ?>
        <span class="login-form__lost link">Забыли?</span>
    </div>
    <div class="form__controls">
        <span id='login-form_submit' class="button">Войти</span>
        <span class="login-form__register link">Зарегистрироваться</span>
    </div>
<?php $this->endWidget(); ?>

