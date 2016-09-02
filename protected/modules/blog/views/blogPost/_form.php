<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blog-post-form',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'title'); ?></div>
        <div><?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?></div>
	</div>

	<div class="row">
		<div class="label"><?php echo $form->labelEx($model,'url'); ?></div>
		<div><?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?></div>
	</div>

	<p><img id="post_image" <?php if(!$model->img): ?>class="hidden"<?php endif; ?> src="<?php echo $model->getImageUrl()?>"/></p>
	<div class="row">
		<div class="label"><?php echo $form->labelEx($model,'image'); ?></div>
		<div><?php echo $form->fileField($model,'image'); ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'description'); ?></div>
        <div><?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?></div>
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
        <div class="label"><?php echo $form->labelEx($model,'tags'); ?></div>
        <div><?php echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>255)); ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'likeCount'); ?></div>
        <div><?php echo $form->textField($model,'likeCount'); ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'is_show'); ?></div>
		<div><?php echo $form->checkBox($model,'is_show'); ?></div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#post_image').attr('src', e.target.result);
				$('#post_image').removeClass('hidden');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#BlogPost_image").change(function(){
		readURL(this);
	});
</script>