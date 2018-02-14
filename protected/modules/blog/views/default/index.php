<!-- Start Blog Area -->
<section class="htc__blog__area bg__white pb--70">
    <div class="container">
        <div class="row">
            <div class="ht__blog__wrap blog--page clearfix">
                <!-- Start Single Blog -->

                <?php if (isset($_GET['tag'])):?>
                    <div class="blog_header">
                        <h1>Показаны статьи по тэгу <span><?=$_GET['tag']?></span></h1>
                        <div class="blog_all_articles">
                            <a href="/blog/">Все статьи</a>
                        </div>
                    </div>
                <?php endif; ?>


                <?php foreach ($posts as $post): ?>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="blog">
                            <div class="blog__thumb">
                                <?php if ($post->img):?>
                                    <a href="/blog/<?= $post->url ?><?php if (isset($_GET['tag'])):?>?tag=<?=$_GET['tag']?><?php endif; ?>">
                                        <img src="<?php echo $post->getImageUrl()?>" alt="<?= $post->title ?>">
                                    </a>
                                <?php endif; ?>
                                <div class="bl_hover">
                                    <?php foreach ($post->tagsArr as $key=>$tag): ?>
                                        <a href="?tag=<?= $tag ?>"><span><?= $tag ?></span></a>&nbsp;<?php if (isset($post->tagsArr[$key+1])):?>,<?php endif;?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="blog__details">
                                <h2><a href="/blog/<?= $post->url ?><?php if (isset($_GET['tag'])):?>?tag=<?=$_GET['tag']?><?php endif; ?>"><?= $post->title ?></a></h2>
                                <ul class="ht__blog__meta">
                                    <li><i class="icon-clock icons"></i><?= $this->dateFormat($post->date_create) ?></li>
                                </ul>
                                <p><?= $post->description ?></p>
                                <div class="blog__btn">
                                    <a href="/blog/<?= $post->url ?><?php if (isset($_GET['tag'])):?>?tag=<?=$_GET['tag']?><?php endif; ?>"><i class="zmdi zmdi-long-arrow-right"></i>Подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- End Single Blog -->
            </div>
        </div>
    </div>
</section>
<!-- End Blog Area -->