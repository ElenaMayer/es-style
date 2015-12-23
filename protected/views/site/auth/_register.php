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
    <?php echo $form->textFieldGroup($modelAuth, 'email', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
</div>
<div class="row">
    <div class="form-group subscribed">
        <?php echo $form->checkBox($modelAuth,'is_subscribed'); ?>
        <?php echo $form->labelEx($modelAuth,'is_subscribed'); ?>
    </div>
</div>
<div class="row">
    <div class="form-group few_field">
        <?php echo $form->labelEx($modelAuth,'date_of_birth'); ?>
        <?php echo $form->dropDownList($modelAuth,'date', $modelAuth->getDatesArray(), array('class' => 'form-control left_field')); ?>
        <?php echo $form->dropDownList($modelAuth,'month', $modelAuth->getMonthsArray(), array('class' => 'form-control middle_field')); ?>
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
    <?php echo $form->passwordFieldGroup($modelAuth, 'password1', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
</div>
<div class="row">
    <?php echo $form->passwordFieldGroup($modelAuth, 'password2', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
</div>
<div class="form__controls">
    <span class="button button_blue">
        <?php echo CHtml::ajaxSubmitButton('Зарегистрироваться',
            CHtml::normalizeUrl(array('/site/registration')),
            array(
                'type' => 'POST',
                'success' => 'js: function(data) {
                                if (data == 1){
                                    window.location.reload();
                                }else {
                                    $("#register-form").html(data);
                                    $(".button_in-progress").removeClass("button_in-progress").removeClass("button_disabled").prop( "disabled", false );
                                }
                    }',
                ),
            array(
                'class' => 'auth_button'
        )); ?>
        <span class="button__progress"></span>
    </span>
    <span class="register-form__login link">У меня есть аккаунт</span>
</div>

<?php $this->endWidget(); ?>