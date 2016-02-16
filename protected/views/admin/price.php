<h1>Прайсы</h1>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'price-form',
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>

    <div class="row">
        <?php echo $form->fileField($model_new,'file'); ?>
        <?php echo $form->error($model_new, 'file'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Добавить', array('class'=>'button')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'price-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'selectableRows'=>false,
    'columns'=>array(
        array(
            'name'=>'file',
            'type'=>'raw',
            'value'=>'"<a href=\"'.$model->getFileUrl().'$data->file\">$data->file</a>"',
        ),
        'date_create',
        array(
            'class' => 'CButtonColumn',
            'template'=>'{delete}',
            'buttons'=>array(
                'delete'=>array(
                    'url'=>'"/admin/priceDelete/".$data->id',
                ),
            ),
        ),
    ),
)); ?>