<h1>Отзывы и комменатрии</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'coupon-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'selectableRows'=>false,
    'columns'=>array(
        'id',
        array(
            'name' => 'user_id',
            'type'=>'raw',
            'value'=> '"<a href=\"/admin/user/update?id=$data->user_id\">$data->user_id</a>"',
        ),
        'name',
        'city',
        'email',
        'rating',
        array(
            'name' => 'type',
            'type'=>'raw',
            'value'=> '$data->type == "reviews"?"Отзыв":($data->type == "review_answer"?"Ответ на отзыв":"Комментарий к статье")',
            'filter'=>["reviews"=>'Отзыв',"review_answer"=>'Ответ на отзыв',"blog_post"=>'Комментарий к статье'],
        ),
        array(
            'name' => 'is_show',
            'type'=>'raw',
            'value'=> '$data->is_show == 1?"Да":"Нет"',
            'filter'=>[1=>'Да',0=>'Нет'],
        ),
        'date_create',
        array(
            'class' => 'CButtonColumn',
            'template'=>'{view}',
            'buttons'=>array(
                'view'=>array(
                    'url'=>'"/admin/commentView/".$data->id',
                ),
            )
        ),
    ),
)); ?>