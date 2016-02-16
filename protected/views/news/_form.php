<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'title'); ?></div>
        <div><?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'content'); ?></div>
        <div>
            <?php $this->widget('application.extensions.tiny_mce.TinyMCE', [
                'model'=>$model,
                'attribute'=>'content',
                'editorOptions'=>[
                    'language'=>'ru',
                    'width'=>'100%',
                    'height'=>'300px'
                ],
                'htmlOptions'=>['class'=>'editor',
                    'width'=>'100%',
                    'height'=>'300px']
            ]); ?>
        </div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'date_publish'); ?></div>
        <div><?php echo $form->dateField($model,'date_publish'); ?></div>
	</div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'is_show'); ?></div>
        <div><?php echo $form->checkBox($model,'is_show'); ?></div>
    </div>
    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'is_send_mail'); ?></div>
        <div>
            <?php if(!$model->is_send_mail): ?>
                <?php echo $form->checkBox($model,'is_send_mail'); ?>
            <?php else: ?>
                Отправлена
            <?php endif; ?>
        </div>
    </div>


	<div class="row buttons indent">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->