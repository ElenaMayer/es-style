<h1>Заказ №<?php echo $model->id; ?></h1>

<?php
$attr = array(
    'id',
    array(
        'name' => 'type',
        'value'=> $model->type == "shipping"?"Розница":"Опт",
    ),
    'date_create',
    'name',
    'email',
    'phone',
);
if($model->type == "shipping"){
    array_push($attr, 'postcode');
    array_push($attr, 'address');
} else {
    array_push($attr, 'company');
    array_push($attr, 'city');
    array_push($attr, 'delivery');
}
array_push($attr, 'order');
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=> $attr,
)); ?>
