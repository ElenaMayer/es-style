<h1>Заказы розница</h1>

<?php

$this->menu=array(
    array('label'=>'List OrderHistory', 'url'=>array('index')),
    array('label'=>'Create OrderHistory', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#order-history-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'order-history-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'addressee',
        array(
            'name'=>'status',
            'value'=>'Yii::app()->params["orderStatuses"][$data->status]',
            'filter'=>Yii::app()->params['status'],
        ),
        'total',
        'date_create',
        array(
            'class' => 'CButtonColumn',
            'template'=>'{update} {delete}',
        ),
    ),
)); ?>
