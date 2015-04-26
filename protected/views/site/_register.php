<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'register-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> true,
    'htmlOptions' => array('class' => 'register-form'),
)); ?>
<div class="auth-popup__subtitle">Зарегистрировать аккаунт</div>
<div class="row">
    <?php echo $form->textFieldGroup($modelAuth, 'name', array('placeholder'=>'')); ?>
</div>
<div class="row">
    <?php echo $form->textFieldGroup($modelAuth, 'phone', array('placeholder'=>'+7')); ?>
</div>
<div class="row">
    <?php echo $form->textFieldGroup($modelAuth, 'email', array('placeholder'=>'')); ?>
</div>
<div class="row">
    <div class="form-group subscribed">
        <?php echo $form->checkBox($modelAuth,'is_subscribed'); ?>
        <?php echo $form->labelEx($modelAuth,'is_subscribed'); ?>
    </div>
</div>
<div class="row">
    <div class="form-group date_of_birth">
        <?php echo $form->labelEx($modelAuth,'date_of_birth'); ?>
        <?php echo $form->dropDownList($modelAuth,'date', $modelAuth->getDatesArray(), array('class' => 'form-control date')); ?>
        <?php echo $form->dropDownList($modelAuth,'month', $modelAuth->getMonthsArray(), array('class' => 'form-control month')); ?>
        <?php echo $form->dropDownList($modelAuth,'year', $modelAuth->getYearsArray(), array('class' => 'form-control')); ?>
    </div>
</div>
<div class="row sex">
    <?php echo $form->dropDownListGroup($modelAuth, 'sex', array(
        'widgetOptions' => array(
            'data' => ['female'=>'Женский', 'male'=>'Мужской'],
            'htmlOptions' => array('class' => 'form-control'),
        ))); ?>
</div>
<div class="row">
    <?php echo $form->passwordFieldGroup($modelAuth, 'password', array('placeholder'=>'')); ?>
</div>
<div class="row">
    <?php echo $form->passwordFieldGroup($modelAuth, 'password2', array('placeholder'=>'')); ?>
</div>
<div class="form__controls">
    <span id='register-form_submit' class="button">Зарегистрироваться</span>
    <span class="register-form__login link">У меня есть аккаунт</span>
</div>

<?php $this->endWidget(); ?>
