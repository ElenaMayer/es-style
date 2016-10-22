<div class="blog">
    <?php if (isset($_GET['tag'])):?>
        <div class="blog_header">
            <h1>Показаны статьи по тэгу <span><?=$_GET['tag']?></span></h1>
            <div class="blog_all_articles">
                <a href="/blog/">Все статьи</a>
            </div>
        </div>
    <?php endif; ?>
    <?php foreach ($posts as $post): ?>
        <div class="blog_article">
            <div class="blog_date">
                <?= $this->dateFormat($post->date_create) ?>
            </div>
            <h2 class="blog_title">
                <a href="/blog/<?= $post->url ?><?php if (isset($_GET['tag'])):?>?tag=<?=$_GET['tag']?><?php endif; ?>"><?= $post->title ?></a>
            </h2>
            <?php if ($post->img):?>
                <div class="blog_image">
                    <img src="<?php echo $post->getImageUrl()?>" >
                </div>
            <?php endif; ?>
            <div class="blog_description">
                <p><?= $post->description ?></p>
            </div>
            <div class="blog_tags">
                Тэги:&nbsp;
                <?php foreach ($post->tagsArr as $key=>$tag): ?>
                    <a href="?tag=<?= $tag ?>"><?= $tag ?></a>&nbsp;<?php if (isset($post->tagsArr[$key+1])):?>,<?php endif;?>
                <?php endforeach; ?>
            </div>
            <a class="blog_readmore blog_button" href="/blog/<?= $post->url ?>">Подробнее</a>
            <span class="blog_comment">
                <a class="blog_button_border" href="/blog/<?= $post->url ?>#comments">Комментариев: <?= $post->getActiveCommentCount() ?></a>
            </span>
            <span class="blog_like">
                Нравиться: <p><?= $post->likeCount ?></p>
                <span id="<?= $post->id ?>" class="blog_like_icon"></span>
            </span>
        </div>
    <?php endforeach; ?>
    <div class="blog_footer">
        <div class="blog_pager">
            <?php $this->widget('CLinkPager', array(
                'pages' => $pagination,
                'header' => '',
                'nextPageLabel' => '>',
                'prevPageLabel' => '<',
                'firstPageLabel' => '<<',
                'lastPageLabel' => '>>',
                'maxButtonCount' => Yii::app()->controller->module->maxButtonCount
            )); ?>
        </div>
    </div>
</div>

<script>
    $( ".blog_like_icon" ).on( "click", function() {
        id = $(this).attr('id');
        if ($(this).hasClass('like')) {
            $.post( "/blog/default/unlike/id/" + id, function(data) {
                e = $('#'+id+'.blog_like_icon');
                e.removeClass('like');
                count = e.parent('.blog_like').children('p');
                count.text(parseInt(count.text())-1);
            }, "json")
        } else {
            $.post( "/blog/default/like/id/" + id, function(data) {
                e = $('#'+id+'.blog_like_icon');
                e.addClass('like');
                count = e.parent('.blog_like').children('p');
                count.text(parseInt(count.text())+1);
            }, "json")
        }
    });
</script>