<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(/data/images/bg/blog.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="/">Главная</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <a class="breadcrumb-item" href="/blog">Блог</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <?php if (isset($_GET['tag'])):?>
                                <a class="breadcrumb-item" href="/blog?tag=<?= $_GET['tag'] ?>"><?= $_GET['tag'] ?></a>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <?php endif; ?>
                            <span class="breadcrumb-item active"><?=$post->title?></span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Blog Details Area -->
<section class="htc__blog__details bg__white ptb--70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="htc__blog__details__wrap">
                    <h2><?= $post->title ?></h2>
                    <ul class="ht__blog__meta">
                        <li><i class="icon-clock icons"></i><?= $this->dateFormat($post->date_create) ?></li>
                    </ul>
                    <div class="ht__bl__thumb">
                        <?php if ($post->img):?>
                            <div class="blog_image">
                                <img src="<?php echo $post->getImageUrl()?>" alt="<?=$post->title?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="bl__dtl">
                        <p class="description"><?= $post->description ?></p>
                        <p><?= $post->content ?></p>
                    </div>
                    <?php foreach ($post->tagsArr as $key=>$tag): ?>
                        <span class="ht__fashion__show">
                            <a href="/blog?tag=<?= $tag ?>"><?= $tag ?></a>&nbsp;<?php if (isset($post->tagsArr[$key+1])):?> <?php endif;?>
                        </span>
                    <?php endforeach; ?>
                    <!-- Start comment Form -->
                    <div class="ht__comment__form">
                        <h4 class="title__line--5">Оставить комментарий</h4>
                        <div class="ht__comment__form__inner">
                            <div class="comment__form">
                                <input type="text" placeholder="Имя *">
                            </div>
                            <div class="comment__form message">
                                <textarea name="message"  placeholder="Комментарий"></textarea>
                            </div>
                        </div>
                        <div class="ht__comment__btn">
                            <a href="#"><i class="icon-envelope icons"></i>Отправить</a>
                        </div>
                    </div>
                    <!-- End comment Form -->
                    <div class="blog post">
                        <div id="comment-data">
                            <?php $this->renderPartial('comments', [
                                'post' => $post,
                                'comments' => $comments,
                                'newComment' => $newComment
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Blog Details Area -->

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