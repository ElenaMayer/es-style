<h1>Купоны</h1> <a href='/admin/couponGenerate' class="admin_title_link button">Сгенерировать купоны</a></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'coupon-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'selectableRows'=>false,
    'columns'=>array(
        'id',
        'coupon',
        'sale',
        array(
            'name' => 'type',
            'type'=> 'raw',
            'value'=> 'Coupon::types()[$data->type]',
            'filter'=> Coupon::types(),
        ),
        array(
            'name' => 'category',
            'type'=>'raw',
            'value'=> '$data->category?Yii::app()->params[\'categories\'][$data->category]:""',
            'filter'=>Yii::app()->params['categories'],
        ),
        array(
            'name' => 'is_active',
            'type'=>'raw',
            'value'=> '$data->is_active == 1?"Да":"Нет"',
            'filter'=>[1=>'Да',0=>'Нет'],
        ),
        array(
            'name' => 'is_reusable',
            'type'=>'raw',
            'value'=> '$data->is_reusable == 1?"Да":"Нет"',
            'filter'=>[1=>'Да',0=>'Нет'],
        ),
        array(
            'name' => 'is_used',
            'type'=>'raw',
            'value'=> '$data->is_used == 1?"Да":"Нет"',
            'filter'=>[1=>'Да',0=>'Нет'],
        ),
        'until_date',
        'date_create',
    ),
)); ?>