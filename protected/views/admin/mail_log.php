<h1>Лог отправки писем</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'mailLog-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'selectableRows'=>false,
    'columns'=>array(
        'id',
        'email',
        'action',
        'send_date',
    ),
)); ?>