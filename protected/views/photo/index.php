<h1>Галерея</h1>
<a href='<?php echo $this->createUrl('admin/photo/create'); ?>' class="admin_title_link button">Добавить фото</a>
Отправить новости (из консоли): php yiic mail newPhotos

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
            'value'=> '"<p class=\"icon\">".CHtml::openTag("span", ["id" => $data->id, "class" => $data->is_show == 1?"is_show":"is_show false", "onclick"=>"set_photo_param(this, \"is_show\")"])."</span></p>"',
            'filter'=>[1=>'Да',0=>'Нет'],
        ),
        array(
            'name' => 'is_available',
            'type'=>'raw',
            'value'=> '"<p class=\"icon\">".CHtml::openTag("span", ["id" => $data->id, "class" => $data->is_available == 1?"is_available":"is_available false", "onclick"=>"set_photo_param(this, \"is_available\")"])."</span></p>"',
            'filter'=>[1=>'Да',0=>'Нет'],
        ),
        array(
            'name' => 'is_new',
            'type'=>'raw',
            'value'=> '"<p class=\"icon\">".CHtml::openTag("span", ["id" => $data->id, "class" => $data->is_new == 1?"is_new":"is_new false", "onclick"=>"set_photo_param(this, \"is_new\")"])."</span></p>"',
            'filter'=>[1=>'Да',0=>'Нет'],
        ),
        array(
            'name' => 'is_hit',
            'type'=>'raw',
            'value'=> '"<p class=\"icon\">".CHtml::openTag("span", ["id" => $data->id, "class" => $data->is_hit == 1?"is_hit":"is_hit false", "onclick"=>"set_photo_param(this, \"is_hit\")"])."</span></p>"',
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
    function set_photo_param(e, param) {
        $.ajax({
            url: '/ajax/setPhotoParam',
            data: {
                id: $(e).attr('id'),
                param: param
            },
            type: "POST",
            dataType : "html",
            success: function( ) {
                if ($(e).hasClass('false'))
                    $(e).removeClass('false');
                else
                    $(e).addClass('false');
            }});
    }
</script>