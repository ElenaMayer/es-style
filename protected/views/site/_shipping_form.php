<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'order-form',
)); ?>

	<p>Поля, отмеченные <span class="required">*</span> обязательны для заполнения.</p>

	<div class="row">
		<?php echo $form->textFieldGroup($model,'name'); ?>
	</div>
	<div class="row">
		<?php echo $form->textFieldGroup($model,'address',array('size'=>60,'maxlength'=>255)); ?>
	</div>
    <div class="row">
        <?php echo $form->textFieldGroup($model,'postcode'); ?>
    </div>
    <div class="row">
        <?php echo $form->textFieldGroup($model,'phone',array('size'=>60,'maxlength'=>255)); ?>
    </div>
	<div class="row">
		<?php echo $form->textFieldGroup($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	<div class="row">
		<?php echo $form->textFieldGroup($model,'size',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	<div class="row">
		<?php echo $form->textAreaGroup($model,'order',array('rows'=>6, 'cols'=>50)); ?>
	</div>
	<div class="row buttons">
        <?php $this->widget( 'booster.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'label' => 'Отправить'
            )
        ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->