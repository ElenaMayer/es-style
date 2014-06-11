<?php
/* @var $this PhotoController */
/* @var $model Photo */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#photo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Галерея <a href='<?php echo $this->createUrl('admin/photo/create'); ?>' class="admin_title_link">Добавить</a></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'photo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'img',
		'category_id',
		'article',
		'price',
		'title',
		'is_show',
		'date_create',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
