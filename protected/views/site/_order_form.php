<?php
$this->widget('booster.widgets.TbAlert', array(
    'id' => 'alert',
    'fade' => true,
    'closeText' => '&times;', // false equals no close link
    'events' => array(),
    'htmlOptions' => array(),
    'userComponentId' => 'user',
    'alerts' => array(
        'warning' => array('closeText' => '&times;'),
    ),
));
?>
<div class="form">

    <?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
        'id'=>'order-form',
    )); ?>

    <p>Поля, отмеченные <span class="required">*</span> обязательны для заполнения.</p>

    <div class="row">
        <?php echo $form->textFieldGroup($model,'name'); ?>
    </div>
    <?php if($type == 'wholesale') :?>
        <div class="row">
            <?php echo $form->textFieldGroup($model,'company',array('size'=>60,'maxlength'=>255)); ?>
        </div>
        <div class="row">
            <?php echo $form->textFieldGroup($model,'city',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    <?php endif;?>
    <?php if($type == 'shipping') :?>
        <div class="row">
            <?php echo $form->textFieldGroup($model,'address',array('size'=>60,'maxlength'=>255)); ?>
        </div>
        <div class="row">
            <?php echo $form->textFieldGroup($model,'postcode'); ?>
        </div>
    <?php endif;?>
    <div class="row">
        <?php echo $form->textFieldGroup($model,'phone',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="row">
        <?php echo $form->textFieldGroup($model,'email',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <?php if($type == 'shipping') :?>
        <div class="row">
            <?php echo $form->textFieldGroup($model,'size',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    <?php endif;?>
    <div class="row">
        <?php echo $form->textAreaGroup($model,'order',array('rows'=>6, 'cols'=>50)); ?>
    </div>
    <div class="row buttons">
        <?php $this->widget( 'booster.widgets.TbButton',
            array(
                'id' => 'submit',
                'label' => 'Отправить'
            )
        ); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
