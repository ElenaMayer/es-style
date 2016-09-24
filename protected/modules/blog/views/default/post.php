<div class="breadcrumbs blog_breadcrumbs">
    <a href="/" class="breadcrumbs__item">Главная</a>
    <a class="breadcrumbs__item" href="/blog">Статьи</a>
    <?php if (isset($_GET['tag'])):?><a class="breadcrumbs__item" href="/blog?tag=<?= $_GET['tag'] ?>"><?= $_GET['tag'] ?></a><?php endif; ?>
    <span class="breadcrumbs__item"><?=$post->title?></span>
</div>
<div class="blog post">
    <div class="blog_article">
        <div class="blog_date">
            <?= $this->dateFormat($post->date_create) ?>
        </div>
        <h2 class="blog_title">
            <?= $post->title ?>
        </h2>
        <?php if ($post->img):?>
            <div class="blog_image">
                <img src="<?php echo $post->getImageUrl()?>" >
            </div>
        <?php endif; ?>
        <div class="blog_description">
            <p><?= $post->description ?></p>
        </div>
        <div class="blog_content">
            <p><?= $post->content ?></p>
        </div>
        <div class="blog_tags">
            Тэги:&nbsp;
            <?php foreach ($post->tagsArr as $key=>$tag): ?>
                <a href="/blog?tag=<?= $tag ?>"><?= $tag ?></a>&nbsp;<?php if (isset($post->tagsArr[$key+1])):?>,<?php endif;?>
            <?php endforeach; ?>
        </div>
        <?php if ($post->getNextPostUrl()):?>
            <a class="blog_next_url blog_button_border" href="<?= $post->getNextPostUrl() ?>">Следующая статья</a>
        <?php endif;?>
        <?php if ($post->getPreviousPostUrl()):?>
            <a class="blog_previous_url blog_button_border" href="<?= $post->getPreviousPostUrl() ?>">Предыдущия статья</a>
        <?php endif;?>
        <span class="blog_like">
            Нравиться: <p><?= $post->likeCount ?></p>
            <span id="<?= $post->id ?>" class="blog_like_icon"></span>
        </span>
    </div>
    <div id="comment-data">
        <?php $this->renderPartial('comments', [
                'post' => $post,
                'comments' => $comments,
                'newComment' => $newComment
            ]); ?>
    </div>
</div>

<script>
    $( ".blog_like_icon" ).on( "click", function() {
        if ($(this).hasClass('like')) {
            $.post( "/blog/default/unlike/id/" + $(this).attr('id'), function(data) {
                $('.blog_like_icon').removeClass('like');
                count = $('.blog_like>p');
                count.text(parseInt(count.text())-1);
            }, "json")
        } else {
            $.post( "/blog/default/like/id/" + $(this).attr('id'), function(data) {
                $('.blog_like_icon').addClass('like');
                count = $('.blog_like>p');
                count.text(parseInt(count.text())+1);
            }, "json")
        }
    });
</script>