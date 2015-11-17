<h1 class="account-header__title">Мои данные</h1>
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'customer_person_data',
    'htmlOptions' => array('class' => 'user-form'),
)); ?>
    <?php echo CHtml::hiddenField('data_type', 'customer_person_data'); ?>
    <div class="row">
        <?php echo $form->textFieldGroup($user, 'surname', array('placeholder'=>'')); ?>
    </div>
    <div class="row">
        <?php echo $form->textFieldGroup($user, 'name', array('placeholder'=>'')); ?>
    </div>
    <div class="row">
        <?php echo $form->textFieldGroup($user, 'middlename', array('placeholder'=>'')); ?>
    </div>
    <div class="row">
        <?php echo $form->textFieldGroup($user, 'phone', array('placeholder'=>'+7')); ?>
    </div>
    <div class="row">
        <div class="form-group">
            <?php echo $form->textField($user, 'email', array('disabled'=>"disabled", 'class' => 'form-control')); ?>
            <?php echo $form->labelEx($user,'email'); ?>
        </div>
    </div>

    <div class="row">
        <?php echo $form->textFieldGroup($user, 'postcode', array('placeholder'=>'')); ?>
    </div>
    <div class="row">
        <div class="form-group address">
            <?php echo $form->labelEx($user,'address'); ?>
            <?php echo $form->textField($user, 'address', array('placeholder'=>'', 'class' => 'form-control')); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>