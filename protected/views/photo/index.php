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
        array(
            'name'=>'img',
            'type'=>'raw',
            'value'=>'"<p class=\"photo\"><img src=\"'.$model->getPreviewUrl().'p_$data->img\" class=\"photo\"></p>"',
        ),array(
            'name'=>'category_id',
            'value'=>'Yii::app()->params["categories"][$data->category_id]',
        ),
        'article',
        'price',
        'is_show',
        'is_new',
        'date_create',
        array(
            'class' => 'CButtonColumn',
            'template'=>'{update} {delete}',
        ),
    ),
    'selectionChanged'=>
        'function(id){ location.href = "'.$this->createUrl('update').'/"+$.fn.yiiGridView.getSelection(id);}',
)); ?>