<h1>Пользователи</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
		'id',
		'name',
        'surname',
		'phone',
		'email',
        array(
            'name' => 'blocked',
            'type'=>'raw',
            'value'=> '$data->blocked == 1?"Да":""',
            'filter'=>[1=>'Да',0=>'Нет'],
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{update} {delete}',
        ),
    ),
)); ?>
