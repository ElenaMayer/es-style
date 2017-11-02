<h2 class="account-header__title">Данные для доставки</h2>
<?php $this->renderPartial('_alert'); ?>
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'customer_shipping_data',
    'htmlOptions' => array('class' => 'user-form'),
)); ?>
<?php echo CHtml::hiddenField('data_type', 'customer_shipping_data'); ?>
<?php if(Yii::app()->user->is_wholesaler): ?>
    <div class="row tc-list">
        <?php echo $form->dropDownListGroup($model, 'tc', array(
            'widgetOptions' => array(
                'data' => array_merge([0 => 'Не выбрано'], Yii::app()->params['tcList']),
                'htmlOptions' => array('class' => 'form-control'),
            ))); ?>
    </div>
    <div class="row delivery_data-field">
        <div class="form-group address">
            <?php echo $form->labelEx($model,'delivery_data'); ?>
            <?php echo $form->textField($model, 'delivery_data', array('placeholder'=>'Город, паспортные данные, ФИО получателя, телефон (если отличается от данных заказчика)', 'class' => 'form-control')); ?>
        </div>
    </div>
<?php endif;?>
<div class="pr-data">
    <div class="row">
        <?php echo $form->textFieldGroup($model, 'postcode', array('placeholder'=>'')); ?>
    </div>
    <div class="row">
        <div class="form-group address">
            <?php echo $form->labelEx($model,'address'); ?>
            <?php echo $form->textField($model, 'address', array('placeholder'=>'', 'class' => 'form-control')); ?>
        </div>
    </div>
</div>
<div class="row buttons">
    <span class="button button_blue button_big" id="submit-button">
        <span class="button__title">Сохранить</span>
        <span class="button__progress"></span>
    </span>
</div>
<?php $this->endWidget(); ?>

<script>
    $( document ).ready(function() {
        if ($('#User_tc').val() == 'pr') {
            $('.delivery_data-field').hide();
        } else {
            $('.pr-data').hide();
        }
    });
    $("#User_tc").change(function() {
        if($(this).val() == 'pr') {
            $('.delivery_data-field').hide();
            $('.pr-data').show();
        } else {
            $('.pr-data').hide();
            $('.delivery_data-field').show();
        }
    });
</script>
