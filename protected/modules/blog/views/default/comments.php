<!-- Start Comment Area -->
<div class="htc__comment__area">
    <h4 class="title__line--5">Всего комментариев: <?= $post->getActiveCommentCount() ?></h4>
    <div class="ht__comment__content">
        <?php if (!empty($comments)): ?>
            <?php foreach($comments as $key => $comment): ?>
                <!-- Start Single Comment -->
                <div class="comment">
                    <div class="comment__thumb">
                        #<?= $key+1 ?>
                    </div>
                    <div class="ht__comment__details">
                        <div class="ht__comment__title">
                            <h2><?= $comment->name ?></h2>
                        </div>
                        <span><?= $this->dateFormatWithTime($comment->date_create) ?></span>
                        <p><?= $comment->comment ?></p>
                    </div>
                </div>
                <!-- End Single Comment -->
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<!-- End Comment Area -->