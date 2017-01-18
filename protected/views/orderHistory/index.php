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

<div class="payment-info" style="display: none"></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'order-history-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'rowCssClassExpression'=>'$data->getColor()',
    'selectableRows'=>false,
//    'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('update').'?id="+$.fn.yiiGridView.getSelection(id);}',
    'columns'=>array(
        'id',
        'addressee',
        'postcode',
        array(
            'name'=>'status',
            'cssClassExpression' => '"status"',
            'value'=>'Yii::app()->params["orderStatuses"][$data->status]',
            'filter'=>Yii::app()->params['status'],
        ),
        'track_code',
        'total',
        'total_with_commission',
        'date_create',
        array(
            'name' => 'is_paid',
            'type'=>'raw',
            'value'=> '"<p class=\"is-paid\">".CHtml::openTag("span", ["id" => $data->id, "class" => ($data->status == "payment" && $data->is_paid != 1)?"check-payment":""]).($data->is_paid == 1?"Оплачено":"Не оплачено")."</span></p>"',
            'filter'=>[1=>'Оплачено',0=>'Не оплачено'],
        ),
        array(
            'class' => 'CButtonColumn',
            'template'=>'{update} {delete}',
        ),
    ),
)); ?>

<script>

    $( "body" ).on( "click", ".check-payment", function() {
        if(!$(this).hasClass('disabled')) {
            $.each($('.check-payment'), function () {
                $(this).addClass('disabled');
            });
            order_id = $(this).attr('id');
            $.post("/ajax/checkPayment", {order_id: order_id})
                .done(function (data) {
                    if (data) {
                        var is_json = true;
                        try {
                            var json = $.parseJSON(data);
                        } catch(err) {
                            is_json = false;
                        }
                        if(json['action'])
                            window.location.reload();
                        else {
                            e = $('.payment-info');
                            if (json['error']) {
                                e.html(json['error']);
                                e.addClass('error');
                            } else if (json['info']) {
                                e.removeClass('error');
                                e.html(json['info']);
                            }
                            e.show();
                            $.each($('.check-payment'), function () {
                                $(this).removeClass('disabled');
                            });
                        }
                    }
                })
        }
    });
</script>