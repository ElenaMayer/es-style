<h2 class="title__line--3">Данные для доставки</h2>
<?php $this->renderPartial('_alert'); ?>
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'customer_shipping_data',
    'htmlOptions' => array('class' => 'user-form'),
)); ?>
<?php echo CHtml::hiddenField('data_type', 'customer_shipping_data'); ?>

<?php if(Yii::app()->user->is_wholesaler): ?>
    <div class="single-contact-form tc-list">
        <?php echo $form->labelEx($model,'tc'); ?>
        <div class="contact-box">
            <?php echo $form->dropDownList($model,'tc', Yii::app()->params['tcList']); ?>
        </div>
    </div>
    <div class="single-contact-form delivery_data-field">
        <div class="contact-box message">
            <?php echo $form->textArea($model, 'delivery_data', array('placeholder'=>'Данные для отправки (Город, паспортные данные, ФИО получателя, телефон)')); ?>
        </div>
    </div>
<?php endif;?>
<div class="pr-data">
    <div class="single-contact-form">
        <div class="contact-box name">
            <?php echo $form->textField($model, 'postcode', array('placeholder'=>'Индекс')); ?>
        </div>
    </div>
    <div class="single-contact-form">
        <div class="contact-box subject">
            <?php echo $form->textField($model, 'address', array('placeholder'=>'Адрес')); ?>
        </div>
    </div>
</div>

<div class="contact-btn" id="submit-button">
    <button type="submit" class="fv-btn">Сохранить</button>
</div>
<div class="form-output">
    <p class="form-messege"></p>
</div>
<?php $this->endWidget(); ?>

<script>
    $( document ).ready(function() {
        if ($('#User_tc').val().length > 0 && $('#User_tc').val() != 'pr') {
            $('.pr-data').hide();
        } else {
            $('.delivery_data-field').hide();
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
