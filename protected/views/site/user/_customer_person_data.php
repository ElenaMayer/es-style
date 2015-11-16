<h1 class="account-header__title">Мои данные</h1>
<?php $this->renderPartial('_alert'); ?>
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'customer_person_data',
    'htmlOptions' => array('class' => 'user-form'),
)); ?>
<?php echo CHtml::hiddenField('data_type', 'customer_person_data'); ?>
<div class="row">
    <?php echo $form->textFieldGroup($model, 'surname', array('placeholder'=>'')); ?>
</div>
<div class="row">
    <?php echo $form->textFieldGroup($model, 'name', array('placeholder'=>'')); ?>
</div>
<div class="row">
    <?php echo $form->textFieldGroup($model, 'middlename', array('placeholder'=>'')); ?>
</div>
<div class="row">
    <?php echo $form->textFieldGroup($model, 'phone', array('placeholder'=>'+7')); ?>
</div>
<div class="row">
    <div class="form-group">
        <?php echo $form->textField($model, 'email', array('disabled'=>"disabled", 'class' => 'form-control')); ?>
        <?php echo $form->labelEx($model,'email'); ?>
    </div>
</div>
<div class="row">
    <div class="form-group subscribed">
        <?php echo $form->checkBox($model,'is_subscribed'); ?>
        <?php echo $form->labelEx($model,'is_subscribed'); ?>
    </div>
</div>
<div class="row">
    <div class="form-group few_field">
        <?php echo $form->labelEx($model,'date_of_birth'); ?>
        <?php echo $form->dropDownList($model,'date', $model->getDatesArray(), array('class' => 'form-control left_field')); ?>
        <?php echo $form->dropDownList($model,'month', $model->getMonthsArray(), array('class' => 'form-control middle_field')); ?>
        <?php echo $form->dropDownList($model,'year', $model->getYearsArray(), array('class' => 'form-control')); ?>
    </div>
</div>
<div class="row sex">
    <?php echo $form->dropDownListGroup($model, 'sex', array(
        'widgetOptions' => array(
            'data' => ['female'=>'Женский', 'male'=>'Мужской'],
            'htmlOptions' => array('class' => 'form-control'),
        ))); ?>
</div>
<div class="row buttons">
    <span class="button button_blue button_big" id="submit-button">
        <span class="button__title">Сохранить</span>
        <span class="button__progress"></span>
    </span>
</div>
<?php $this->endWidget(); ?>