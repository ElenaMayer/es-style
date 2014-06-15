<?php
/* @var $this PhotoController */
/* @var $model Photo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'photo-form',
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <?php if($model->img): ?>
        <p><img src="<?php echo $model->getPreviewUrl().'p_'.$model->img ?>"/></p>
    <?php endif; ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

	<div class="row">
		<div class="label"><?php echo $form->labelEx($model,'image'); ?></div>
        <div>
            <?php echo $form->fileField($model,'image'); ?>
		    <?php echo $form->error($model,'image'); ?>
        </div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'category_id'); ?></div>
        <div>
            <?php echo $form->dropDownList($model,'category_id', Yii::app()->params['categories']); ?>
        </div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'article'); ?></div>
        <div>
		    <?php echo $form->textField($model,'article'); ?>
        </div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'price'); ?></div>
        <div>
            <?php echo $form->textField($model,'price'); ?>
        </div>
	</div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'is_new'); ?></div>
        <div>
            <?php echo $form->checkBox($model,'is_new'); ?>
        </div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'is_show'); ?></div>
        <div>
            <?php echo $form->checkBox($model,'is_show'); ?>
        </div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'title'); ?></div>
        <div>
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    </div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'description'); ?></div>
        <div>
            <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        </div>
	</div>

	<div class="row buttons indent">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->