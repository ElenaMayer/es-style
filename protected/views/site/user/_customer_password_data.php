<h2 class="account-header__title">Сменить пароль</h2>
<?php $this->renderPartial('_alert'); ?>
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'customer_password_data',
    'htmlOptions' => array('class' => 'user-form'),
)); ?>
<?php echo CHtml::hiddenField('data_type', 'customer_password_data'); ?>
<div class="row">
    <?php echo $form->passwordFieldGroup($model, 'password_old', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
</div>
<div class="row">
    <?php echo $form->passwordFieldGroup($model, 'password_new', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
</div>
<div class="row">
    <?php echo $form->passwordFieldGroup($model, 'password2', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
</div>
<div class="row buttons">
    <span class="button button_blue button_big" id="submit-button">
        <span class="button__title">Сохранить</span>
        <span class="button__progress"></span>
    </span>
</div>
<?php $this->endWidget(); ?>