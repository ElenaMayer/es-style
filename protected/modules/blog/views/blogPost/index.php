<h1>Блог <a href='/blog/blogPost/create' class="admin_title_link button">Добавить пост</a></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'blog-post-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
		'id',
		'title',
		'url',
		'likeCount',
		array(
			'name' => 'is_show',
			'type'=>'raw',
			'filter'=>[1=>'Да',0=>'Нет'],
			'value'=> '"<p class=\"icon\">".CHtml::openTag("span", ["id" => $data->id, "class" => $data->is_show == 1?"is_show_small":"is_show_small false", "onclick"=>"set_is_show(this)"])."</span></p>"',
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
		$.post( "/blog/blogPost/setIsShow/id/" + $(e).attr('id'), function(data) {
			if ($(e).hasClass('false'))
				$(e).removeClass('false');
			else
				$(e).addClass('false');
		}, "json")
	}
</script>