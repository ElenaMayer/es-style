<h1>Заказ №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'name',
		'region',
		'postcode',
		'address',
		'email',
		'phone',
		'size',
		'company',
		'city',
		'order',
		'date_create',
	),
)); ?>
