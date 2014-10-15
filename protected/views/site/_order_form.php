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
        <?php echo $form->textFieldGroup($model,'name', array('placeholder'=>'')); ?>
    </div>
    <?php if($type == 'wholesale') :?>
        <div class="row">
            <?php echo $form->textFieldGroup($model,'company',array('placeholder'=>'', 'size'=>60,'maxlength'=>255)); ?>
        </div>
        <div class="row">
            <?php echo $form->textFieldGroup($model,'city',array('placeholder'=>'', 'size'=>60,'maxlength'=>255)); ?>
        </div>
    <?php endif;?>
    <?php if($type == 'shipping') :?>
        <div class="row">
            <?php echo $form->textFieldGroup($model,'address',array('placeholder'=>'', 'size'=>60,'maxlength'=>255)); ?>
        </div>
        <div class="row">
            <?php echo $form->textFieldGroup($model,'postcode', array('placeholder'=>'')); ?>
        </div>
    <?php endif;?>
    <div class="row">
        <?php echo $form->textFieldGroup($model,'phone',array('placeholder'=>'', 'size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="row">
        <?php echo $form->textFieldGroup($model,'email',array('placeholder'=>'', 'size'=>60,'maxlength'=>255)); ?>
    </div>
    <?php if($type == 'wholesale') :?>
        <div class="row">
            <?php echo $form->textFieldGroup($model,'delivery',array('placeholder'=>'', 'placeholder'=>'Почта России или название ТК', 'size'=>60,'maxlength'=>255)); ?>
        </div>
    <?php endif;?>
    <div class="row">
        <?php echo $form->textAreaGroup($model,'order',array('placeholder'=>'', 'rows'=>6, 'cols'=>50)); ?>
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
