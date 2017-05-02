<h1>Генерация купонов</h1>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'news-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'is_reusable'); ?></div>
        <div><?php echo $form->checkBox($model,'is_reusable'); ?></div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'type'); ?></div>
        <div><?php echo $form->dropDownList($model,'type', Coupon::types(), array('prompt'=>'')); ?></div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'category'); ?></div>
        <div><?php echo $form->dropDownList($model,'category', Yii::app()->params['categories'], array('prompt'=>'')); ?></div>
    </div>

    <div class="row count_field">
        <div class="label"><?php echo $form->labelEx($model,'count'); ?></div>
        <div><?php echo $form->textField($model,'count'); ?></div>
    </div>

    <div class="row coupon_field" style="display: none">
        <div class="label"><?php echo $form->labelEx($model,'coupon'); ?></div>
        <div><?php echo $form->textField($model,'coupon'); ?></div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'sale'); ?></div>
        <div><?php echo $form->textField($model,'sale'); ?></div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'until_date'); ?></div>
        <div><?php echo $form->dateField($model,'until_date'); ?></div>
    </div>


    <div class="row buttons indent">
        <?php echo CHtml::submitButton('Создать'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    $("#Coupon_is_reusable").click(function() {
        if($(this).prop('checked')) {
            $('.count_field').hide();
            $('.coupon_field').show();
        } else {
            $('.count_field').show();
            $('.coupon_field').hide();
        }
    });
</script>