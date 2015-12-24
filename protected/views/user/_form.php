<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'name'); ?></div>
        <div><?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?></div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'surname'); ?></div>
        <div><?php echo $form->textField($model,'surname',array('size'=>60,'maxlength'=>255)); ?></div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'middlename'); ?></div>
        <div><?php echo $form->textField($model,'middlename',array('size'=>60,'maxlength'=>255)); ?></div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'phone'); ?>
        </div>
        <div><?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'email'); ?></div>
        <div><?php echo CHtml::encode($model->email); ?></div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'date_of_birth'); ?></div>
        <div><?php echo CHtml::encode($model->date_of_birth); ?></div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'sex'); ?></div>
        <div><?php echo (CHtml::encode($model->sex == 'male') ? 'Мужской' : 'Женский'); ?></div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'is_subscribed'); ?></div>
        <div><?php echo $form->checkBox($model,'is_subscribed'); ?></div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'postcode'); ?>
        </div>
        <div><?php echo $form->textField($model,'postcode'); ?>
        </div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'address'); ?>
        </div>
        <div class="address"><?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'blocked'); ?></div>
        <div><?php echo $form->checkBox($model,'blocked'); ?></div>
    </div>

<?php $this->endWidget(); ?>
<?php if(!empty($model->orders)) :?>
    <?php $this->renderPartial('_orders', array('orders'=>$model->orders)); ?>
<?php endif; ?>

</div><!-- form -->