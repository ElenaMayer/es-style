<?php
/* @var $this OrderHistoryController */
/* @var $model OrderHistory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-history-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'user_id'); ?></div>
        <div><?php echo CHtml::encode($model->user_id); ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'status'); ?></div>
        <div><?php echo $form->dropDownList($model,'status', Yii::app()->params['orderStatuses']); ?></div>
	</div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'track_code'); ?></div>
        <div><?php echo $form->textField($model,'track_code'); ?></div>
    </div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'is_paid'); ?></div>
        <div><?php echo (CHtml::encode($model->is_paid) ? 'Да' : 'Нет'); ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'shipping_method'); ?></div>
        <div><?php echo Yii::app()->params["shippingMethod"][$model->shipping_method]; ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'payment_method'); ?></div>
        <div><?php echo Yii::app()->params["paymentMethod"][$model->payment_method]; ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'addressee'); ?></div>
        <div><?php echo CHtml::encode($model->addressee); ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'address'); ?></div>
        <div><?php echo CHtml::encode($model->address); ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'subtotal'); ?></div>
        <div><?php echo CHtml::encode($model->subtotal); ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'sale'); ?></div>
        <div><?php echo CHtml::encode($model->sale); ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'shipping'); ?></div>
        <div><?php echo CHtml::encode($model->shipping); ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'total'); ?></div>
        <div><?php echo CHtml::encode($model->total); ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'date_create'); ?></div>
        <div><?php echo CHtml::encode($model->date_create); ?></div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->