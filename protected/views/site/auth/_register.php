<div class="checkout-method__login">
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'register-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> true,
    'htmlOptions' => array('class' => 'register-form'),
)); ?>


    <p class="checkout-method__subtitle">Зарегистрировать аккаунт:</p>
    <div class="single-input">
        <?php echo $form->textFieldGroup($modelAuth, 'name', array('placeholder'=>'')); ?>
    </div>
    <div class="single-input">
        <?php echo $form->checkBox($modelAuth,'is_wholesaler'); ?>
        <?php echo $form->labelEx($modelAuth,'is_wholesaler'); ?>
    </div>
    <div class="single-input">
        <?php echo $form->textFieldGroup($modelAuth, 'phone', array('placeholder'=>'+7')); ?>
    </div>
    <div class="single-input">
        <?php echo $form->textFieldGroup($modelAuth, 'email', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
    </div>
    <div class="single-input">
        <?php echo $form->checkBox($modelAuth,'is_subscribed'); ?>
        <?php echo $form->labelEx($modelAuth,'is_subscribed'); ?>
    </div>
    <div class="single-input">
        <?php echo $form->labelEx($modelAuth,'date_of_birth'); ?>
        <?php echo $form->dropDownList($modelAuth,'date', $modelAuth->getDatesArray(), array('class' => 'form-control left_field')); ?>
        <?php echo $form->dropDownList($modelAuth,'month', $modelAuth->getMonthsArray(), array('class' => 'form-control middle_field')); ?>
        <?php echo $form->dropDownList($modelAuth,'year', $modelAuth->getYearsArray(), array('class' => 'form-control')); ?>
    </div>
    <div class="single-input">
        <?php echo $form->dropDownListGroup($modelAuth, 'sex', array(
            'widgetOptions' => array(
                'data' => ['female'=>'Женский', 'male'=>'Мужской'],
                'htmlOptions' => array('class' => 'form-control'),
            ))); ?>
    </div>
    <div class="single-input">
        <?php echo $form->passwordFieldGroup($modelAuth, 'password1', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
    </div>
    <div class="single-input">
        <?php echo $form->passwordFieldGroup($modelAuth, 'password2', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
    </div>

    <div class="dark-btn">
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
    </div>

    <h5 class="checkout-method__title"><a class="register-form__login link">У меня есть аккаунт</a></h5>
<?php $this->endWidget(); ?>
</div>
