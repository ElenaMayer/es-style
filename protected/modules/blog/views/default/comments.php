<div class="blog_comments">
    <div id="comments">
        <span class="j-blog-comment-counter"> Комментарии:
            <i class="cc-comments-count"><?= $post->getActiveCommentCount() ?></i>
        </span>
        <ul class="com-list-noava">
            <?php if (!empty($comments)): ?>
                <?php foreach($comments as $key => $comment): ?>
                <li class="commentstd clearover">
                    <strong class="number">#<?= $key+1 ?></strong>
                    <p class="com-meta">
                        <span class="user_name"><?= $comment->name ?></span>
                        <span class="date">(<em><?= $this->dateFormatWithTime($comment->date_create) ?></em>)</span>
                    </p>
                    <p class="commententry">
                        <?= $comment->comment ?>
                    </p>
                </li>
                <?php endforeach; ?>
            <?php endif; ?>
            <li class="commentstd clearover">
                <strong class="number">#<?= $post->getActiveCommentCount()+1 ?></strong>
                <div class="comment_form">
                    <?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
                        'id'=>'comment-form',
                    )); ?>
                        <div>
                            <?php echo $form->textFieldGroup($newComment,'name',array('placeholder'=>'', 'maxlength'=>255)); ?>
                        </div>
                        <div>
                            <?php echo $form->textAreaGroup($newComment,'comment',array('placeholder'=>'')); ?>
                        </div>
                        <div class="blog_submit_button">
                            <?php $this->widget( 'booster.widgets.TbButton',
                                array(
                                    'id' => 'submit',
                                    'label' => 'Отправить'
                                )
                            ); ?>
                        </div>
                        <div style="margin-top: 4px;"><span class="red">*</span> Обязательные поля</div>
                    <?php $this->endWidget(); ?>
                </div>
            </li>
        </ul>
    </div>
</div>

<script>
    $( 'body' ).on( 'click', '#submit', function() {
        $.ajax({
            url: '',
            type: 'POST',
            data: $("#comment-form").serialize(),
            success: function (responseText) {
                console.log($('#comment-data'));
                $('#comment-data').html(responseText);
                $("#comment-form").find('textarea').val('');
            }
        });
    })
</script>