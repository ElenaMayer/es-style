<h1>Заказы розница <a href='<?php echo $this->createUrl('admin/orderHistory/create'); ?>' class="admin_title_link button">Добавить заказ</a></h1>
<?php if(OrderHistory::getOrderNewSum() > 0): ?>
    <div class="orderSum">
        Новых заказов на сумму: <b><?= OrderHistory::getOrderNewSum() ?> руб.</b>
    </div>
<?php endif; ?>
<div class="orderSum">
    Отправлено на сумму (без оплаты): <b><?= OrderHistory::getOrderSendSum() ?> руб.</b>
</div>
<?php if(OrderHistory::getOrderAvailableSum() > 0): ?>
    <div class="orderSum orderAvailableSum">
        Оплачено на сумму: <b><span><?= OrderHistory::getOrderAvailableSum() ?></span> руб.</b>
    </div>
<?php endif; ?>

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
    'rowCssClassExpression'=>'$data->getColor()',
//    'selectableRows'=>1,
//    'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('update').'?id="+$.fn.yiiGridView.getSelection(id);}',
    'columns'=>array(
        'id',
        'addressee',
        'postcode',
        array(
            'name'=>'status',
            'value'=>'Yii::app()->params["orderStatuses"][$data->status]',
            'filter'=>Yii::app()->params['status'],
        ),
        'track_code',
        'total',
        'date_create',
        array(
            'class' => 'CButtonColumn',
            'template'=>'{update} {delete}',
        ),
    ),
)); ?>
