<h1>Новости <a href='<?php echo $this->createUrl('admin/news/create'); ?>' class="admin_title_link button">Добавить новость</a></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'news-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'selectableRows'=>false,
	'columns'=>array(
		'title',
        'date_publish',
        array(
            'name' => 'is_show',
            'type'=>'raw',
            'filter'=>[1=>'Да',0=>'Нет'],
            'value'=> '"<p class=\"icon\">".CHtml::openTag("span", ["id" => $data->id, "class" => $data->is_show == 1?"is_show_small":"is_show_small false", "onclick"=>"set_is_show(this)"])."</span></p>"',
        ),
        array(
            'name' => 'is_send_mail',
            'type'=>'raw',
            'value'=> '$data->is_send_mail == 1?"Отправлена":""',
            'filter'=>[1=>'Да',0=>'Нет'],
        ),
		'date_create',
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
</script>
