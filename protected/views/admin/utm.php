<h1>UTM метки</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'utm-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'selectableRows'=>false,
    'columns'=>array(
        'id',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'date_create',
    ),
)); ?>