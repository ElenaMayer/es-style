<h1>Галерея <a href='<?php echo $this->createUrl('admin/photo/create'); ?>' class="admin_title_link">Добавить</a></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'photo-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'selectableRows'=>false,
    'columns'=>array(
        array(
            'name'=>'img',
            'type'=>'raw',
            'filter'=>false,
            'value'=>'"<p class=\"photo\"><img src=\"'.$model->getPreviewUrl().'$data->img\" class=\"photo\"></p>"',
        ),
        array(
            'name'=>'category',
            'value'=>'Yii::app()->params["categories"][$data->category]',
            'filter'=>Yii::app()->params['categories'],
        ),
        'article',
        'price',
        array(
            'name' => 'is_show',
            'type'=>'raw',
            'value'=> '"<p class=\"icon\">".CHtml::openTag("span", ["id" => $data->id, "class" => $data->is_show == 1?"is_show":"is_show false", "onclick"=>"set_is_show(this)"])."</span></p>"',
            'filter'=>[1=>'Да',0=>'Нет'],
        ),
        array(
            'name' => 'is_new',
            'type'=>'raw',
            'value'=> '"<p class=\"icon\">".CHtml::openTag("span", ["id" => $data->id, "class" => $data->is_new == 1?"is_new":"is_new false", "onclick"=>"set_is_new(this)"])."</span></p>"',
            'filter'=>[1=>'Да',0=>'Нет'],
        ),
        array(
            'name' => 'is_sale',
            'type'=>'raw',
            'value'=> '"<p class=\"icon\">".CHtml::openTag("span", ["id" => $data->id, "class" => $data->is_sale == 1?"is_sale":"is_sale false"])."</span></p>"',
            'filter'=>[1=>'Да',0=>'Нет'],
        ),
        array(
            'name' =>'date_create',
            'filter'=>false,
        ),
        array(
            'class' => 'CButtonColumn',
            'template'=>'{update} {delete}',
        ),
    ),
)); ?>

<script>
    function set_is_show(e){
        $.post( "setIsShow/" + $(e).attr('id'), function() {
            if ($(e).hasClass('false'))
                $(e).removeClass('false');
            else
                $(e).addClass('false');
        }, "json");
    }

    function set_is_new(e){
        $.post( "setIsNew/" + $(e).attr('id'), function() {
            if ($(e).hasClass('false'))
                $(e).removeClass('false');
            else
                $(e).addClass('false');
        }, "json");
    }
</script>