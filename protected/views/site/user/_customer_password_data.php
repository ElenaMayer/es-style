<h2 class="title__line--3">Сменить пароль</h2>
<?php $this->renderPartial('_alert'); ?>
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'customer_password_data',
    'htmlOptions' => array('class' => 'user-form'),
)); ?>
<?php echo CHtml::hiddenField('data_type', 'customer_password_data'); ?>
<div class="single-contact-form">
    <div class="contact-box subject">
        <?php echo $form->passwordField($model, 'password_old', array('placeholder'=>'Текущий пароль', 'autocomplete' => 'off')); ?>
    </div>
</div>
<div class="single-contact-form">
    <div class="contact-box subject">
        <?php echo $form->passwordField($model, 'password_new', array('placeholder'=>'Новый пароль', 'autocomplete' => 'off')); ?>
    </div>
</div>
<div class="single-contact-form">
    <div class="contact-box subject">
        <?php echo $form->passwordField($model, 'password2', array('placeholder'=>'Повторите пароль', 'autocomplete' => 'off')); ?>
    </div>
</div>

<div class="contact-btn" id="submit-button">
    <button type="submit" class="fv-btn">Сохранить</button>
</div>
<div class="form-output">
    <p class="form-messege"></p>
</div>
<?php $this->endWidget(); ?>