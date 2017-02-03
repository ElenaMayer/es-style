<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#order-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Заказы</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'email',
		'phone',
		'date_create',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view} {delete}',
            'buttons'=>array(
                'view'=>array(
                    'url'=>'"/admin/orderView/".$data->id',
                ),
                'delete'=>array(
                    'url'=>'"/admin/orderDelete/".$data->id',
                ),
            )
		),
	),
)); ?>
