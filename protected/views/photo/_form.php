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
        <p><img src="<?php echo $model->getPreviewUrl()?>"/></p>
    <?php endif; ?>

	<div class="row">
		<div class="label"><?php echo $form->labelEx($model,'image'); ?></div>
        <div>
            <?php echo $form->fileField($model,'image'); ?>
		    <?php echo $form->error($model,'image'); ?>
        </div>
	</div>
    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'is_show'); ?></div>
        <div><?php echo $form->checkBox($model,'is_show'); ?></div>
    </div>
	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'category'); ?></div>
        <div><?php echo $form->dropDownList($model,'category', Yii::app()->params['categories']); ?></div>
	</div>
	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'article'); ?></div>
        <div><?php echo $form->textField($model,'article'); ?></div>
	</div>
	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'price'); ?></div>
        <div><?php echo $form->textField($model,'price'); ?></div>
	</div>
    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'is_new'); ?></div>
        <div><?php echo $form->checkBox($model,'is_new'); ?></div>
    </div>
    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'is_sale'); ?></div>
        <div><?php echo $form->checkBox($model,'is_sale'); ?></div>
    </div>

    <div class="sale">
        <div class="row">
            <div class="label"><?php echo $form->labelEx($model,'sale'); ?></div>
            <div><?php echo $form->textField($model,'sale'); ?></div>
        </div>
        <div class="row">
            <div class="label"><?php echo $form->labelEx($model,'old_price'); ?></div>
            <div><?php echo $form->textField($model,'old_price'); ?></div>
        </div>
        <div class="row">
            <div class="label"><?php echo $form->labelEx($model,'new_price'); ?></div>
            <div><?php echo $form->textField($model,'new_price'); ?></div>
        </div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'size'); ?></div>
        <div><?php echo $form->checkBox($model,'size'); ?></div>
    </div>
    <div class="size">
        <div class="row">
            <div class="label"><?php echo $form->labelEx($model,'size_42'); ?></div>
            <div><?php echo $form->checkBox($model,'size_42'); ?></div>
        </div>
        <div class="row">
            <div class="label"><?php echo $form->labelEx($model,'size_44'); ?></div>
            <div><?php echo $form->checkBox($model,'size_44'); ?></div>
        </div>
        <div class="row">
            <div class="label"><?php echo $form->labelEx($model,'size_46'); ?></div>
            <div><?php echo $form->checkBox($model,'size_46'); ?></div>
        </div>
        <div class="row">
            <div class="label"><?php echo $form->labelEx($model,'size_48'); ?></div>
            <div><?php echo $form->checkBox($model,'size_48'); ?></div>
        </div>
        <div class="row">
            <div class="label"><?php echo $form->labelEx($model,'size_50'); ?></div>
            <div><?php echo $form->checkBox($model,'size_50'); ?></div>
        </div>
        <div class="row">
            <div class="label"><?php echo $form->labelEx($model,'size_52'); ?></div>
            <div><?php echo $form->checkBox($model,'size_52'); ?></div>
        </div>
        <div class="row">
            <div class="label"><?php echo $form->labelEx($model,'size_54'); ?></div>
            <div><?php echo $form->checkBox($model,'size_54'); ?></div>
        </div>
    </div>

    <div class="row">
        <div class="label"><?php echo $form->labelEx($model,'title'); ?></div>
        <div><?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?></div>
    </div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'description'); ?></div>
        <div>
            <?php $this->widget('application.extensions.tiny_mce.TinyMCE', [
                'model'=>$model,
                'attribute'=>'description',
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

	<div class="row buttons indent">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    $( document ).ready(function() {
        if($('#Photo_is_sale').prop('checked')) $('.sale').show();
        else $('.sale').hide();
        if($('#Photo_size').prop('checked')) $('.size').show();
        else $('.size').hide();
    });
    $("#Photo_is_sale").click(function() {
        if($(this).prop('checked')) $('.sale').show();
        else $('.sale').hide();
    });
    $("#Photo_size").click(function() {
        if($(this).prop('checked')) $('.size').show();
        else $('.size').hide();
    });
</script>