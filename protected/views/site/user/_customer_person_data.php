<?php $this->renderPartial('_alert'); ?>
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'customer_person_data',
    'htmlOptions' => array('class' => 'user-form'),
)); ?>
<?php echo CHtml::hiddenField('data_type', 'customer_person_data'); ?>

    <div class="single-contact-form">
        <div class="contact-box name">
            <?php echo $form->textField($model, 'surname', array('placeholder'=>'Фамилия')); ?>
            <?php echo $form->textField($model, 'name', array('placeholder'=>'Имя')); ?>
            <?php echo $form->textField($model, 'middlename', array('placeholder'=>'Отчество')); ?>
        </div>
    </div>
    <div class="single-contact-form">
        <div class="contact-box name">
            <?php echo $form->textField($model, 'phone', array('placeholder'=>'Телефон +7xxx-xxx-xxxx')); ?>
            <?php echo $form->textField($model, 'email', array('disabled'=>"disabled")); ?>
        </div>
    </div>
    <div class="single-contact-form">
        <div class="contact-box is_subscribed">
            <?php echo $form->checkBox($model,'is_subscribed'); ?>
            <?php echo $form->labelEx($model,'is_subscribed'); ?>
        </div>
    </div>
    <div class="single-contact-form">
        <?php echo $form->labelEx($model,'date_of_birth'); ?>
        <div class="contact-box date_of_birth">
            <?php echo $form->dropDownList($model,'date', $model->getDatesArray(), array('class' => 'left_field')); ?>
            <?php echo $form->dropDownList($model,'month', $model->getMonthsArray(), array('class' => 'middle_field')); ?>
            <?php echo $form->dropDownList($model,'year', $model->getYearsArray(), array('class' => '')); ?>
        </div>
    </div>
    <div class="single-contact-form">
        <?php echo $form->labelEx($model,'sex'); ?>
        <div class="contact-box">
            <?php echo $form->dropDownList($model,'sex', ['female'=>'Женский', 'male'=>'Мужской']); ?>
        </div>
    </div>
    <div class="contact-btn">
        <button class="fv-btn" id="submit-button">Сохранить</button>
    </div>
    <div class="form-output">
        <p class="form-messege"></p>
    </div>
<?php $this->endWidget(); ?>