<h2 class="account-header__title">Данные для доставки</h2>
<?php $this->renderPartial('_alert'); ?>
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'customer_shipping_data',
    'htmlOptions' => array('class' => 'user-form'),
)); ?>
<?php echo CHtml::hiddenField('data_type', 'customer_shipping_data'); ?>
<div class="row">
    <?php echo $form->textFieldGroup($model, 'postcode', array('placeholder'=>'')); ?>
</div>
<div class="row">
    <div class="form-group address">
        <?php echo $form->labelEx($model,'address'); ?>
        <?php echo $form->textField($model, 'address', array('placeholder'=>'', 'class' => 'form-control')); ?>
    </div>
</div>
<div class="row buttons">
    <span class="button button_blue button_big" id="submit-button">
        <span class="button__title">Сохранить</span>
        <span class="button__progress"></span>
    </span>
</div>
<?php $this->endWidget(); ?>