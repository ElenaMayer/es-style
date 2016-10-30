<?php if ($model->type == 'reviews'):?>
    <h1>Отзыв №<?php echo $model->id; ?></h1>
<?php elseif ($model->type == 'review_answer'):?>
    <h1>Ответ на отзыв <a href='/admin/commentView/<?php echo $model->item_id; ?>'>№<?php echo $model->item_id; ?></a></h1>
<?php else: ?>
    <h1>Комментарий к статье <a href='/blog/blogPost/update/id/<?php echo $model->item_id; ?>'>№<?php echo $model->item_id; ?></a></h1>
<?php endif; ?>

<?php if($model->type == "reviews" && $model->img):?>
    <p><img src="<?php echo $model->getImageUrl()?>"/></p>
<?php endif; ?>

<?php
if($model->type == "reviews"){
    $attr = array(
        'id',
        array(
            'name' => 'is_show',
            'type' => 'raw',
            'value'=> '<input id="Comment_is_show" data_id='.$model->id.($model->is_show?' checked':'').' type="checkbox">'
        ),
        array(
            'name' => 'user_id',
            'type' => 'raw',
            'value'=> $model->user_id ?'<a href=\"/admin/user/update?id='.$model->user_id.'\">'.$model->user_id.'</a>':'Не зарегистрирован'
        ),
        'name',
        'email',
        'city',
        'rating',
        'comment',
        'date_create',
    );
} elseif($model->type == "review_answer") {
    $attr = array(
        'id',
        array(
            'name' => 'is_show',
            'type' => 'raw',
            'value'=> '<input id="Comment_is_show"  data_id='.$model->id.' checked='.$model->is_show.' type="checkbox">'
        ),
        'comment',
        'date_create',
    );
} else {
    $attr = array(
        'id',
        array(
            'name' => 'is_show',
            'type' => 'raw',
            'value'=> '<input id="Comment_is_show"  data_id='.$model->id.' checked='.$model->is_show.' type="checkbox">'
        ),
        array(
            'name' => 'user_id',
            'type' => 'raw',
            'value'=> $model->user_id ?'<a href=\"/admin/user/update?id='.$model->user_id.'\">'.$model->user_id.'</a>':'Не зарегистрирован'
        ),
        'name',
        'comment',
        'date_create',
    );
}
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=> $attr,
)); ?>

<?php if($model->type == "reviews"):?>
    <?php if(!$model->answer):?>
        <div class="comment_answer_form">
            <textarea rows="6" cols="90" placeholder="Текст ответа" id="comment_answer"></textarea>
            <a class="send_answer_button button" data_id=<?= $model->id?>>Ответить</a>
        </div>
    <?php endif; ?>
    <div class="comment_answer" <?php if(!$model->answer):?>style="display: none"<?php endif; ?>>
        <p><b>Ответ на отзыв:</b></p>
        <p id="answer_text"><?php if($model->answer):?><?php echo $model->answer->comment; ?><?php endif; ?></p>
    </div>
<?php endif; ?>

<script>
    $( "body" ).on("click", "#Comment_is_show", function() {
        $.ajax({
            url: "/ajax/setCommentIsShow",
            data: {
                comment_id: $(this).attr('data_id')
            },
            type: "POST",
            dataType: "html"
        });
    });
    $( "body" ).on("click", ".send_answer_button", function() {
        if ($('#comment_answer').val().length > 0) {
            $.ajax({
                url: "/ajax/addAnswerToComment",
                data: {
                    comment_id: $(this).attr('data_id'),
                    answer: $('#comment_answer').val()
                },
                type: "POST",
                dataType: "html",
                success: function (data) {
                    if (data){
                        $('#answer_text').text($('#comment_answer').val());
                        $('.comment_answer').show();
                        $('.comment_answer_form').hide();
                    }
                }
            });
        }
    });
</script>