<?php
$this->pageTitle=Yii::app()->name;
?>

<!-- Start Slider Area -->
<div class="slider__container slider--one">
    <div class="slide__container">
        <div class="container-fluid">
            <div class="row">
                <div class="slider__activation__wrap slider-activation-one no__navigation owl-carousel">
                    <!-- Start Single Slide -->
                    <div class="col-md-4 col-lg-4 slider">
                        <a href="/dress">
                            <div class="slide">
                                <img src="data/images/slider/m1.jpg" alt="Платья">
                                <div class="slider__inner">
                                    <h1>Платья</h1>
                                    <p>В восточном стиле, повседневные, вечерние</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Single Slide -->
                    <!-- Start Single Slide -->
                    <div class="col-md-4 col-lg-4 slider">
                        <a href="/blouse">
                            <div class="slide">
                                <img src="data/images/slider/m2.jpg" alt="Блузки">
                                <div class="slider__inner">
                                    <h1>Блузки</h1>
                                    <p>Блузки, туники, джемперы, кардиганы</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Single Slide -->
                    <!-- Start Single Slide -->
                    <div class="col-md-4 col-lg-4 slider">
                        <a href="/kimono">
                            <div class="slide">
                                <img src="data/images/slider/m3.jpg" alt="Кимоно">
                                <div class="slider__inner">
                                    <h1>Кимоно</h1>
                                    <p>Домашние платья, платья для отпуска</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Single Slide -->
                    <!-- Start Single Slide -->
                    <div class="col-md-4 col-lg-4 slider">
                        <a href="/other">
                            <div class="slide">
                                <img src="data/images/slider/m4.jpg" alt="Разное">
                                <div class="slider__inner">
                                    <h1>Разное</h1>
                                    <p>Холаты, сорочки, домашние комплекты</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Single Slide -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Product Area -->
<section class="htc__product__area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title text--left">
                    <h2 class="title__line title__border">Новинки</h2>
                    <p>#Тренды сезона</p>
                </div>
            </div>
        </div>
        <?php $this->renderPartial('_popular', ['photos' => $newPhotos]); ?>
    </div>
</section>
<!-- End Product Area -->
<!-- Start Product Area -->
<section class="htc__product__area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title text--left">
                    <h2 class="title__line title__border">Популярное</h2>
                    <p>#Хит продаж</p>
                </div>
            </div>
        </div>
        <?php $this->renderPartial('_popular', ['photos' => $hitPhotos]); ?>
    </div>
</section>
<!-- End Product Area -->
<!-- Start Product Area -->
<section class="htc__product__area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title text--left">
                    <h2 class="title__line title__border">Скидки</h2>
                    <p>#Максимальная выгода</p>
                </div>
            </div>
        </div>
        <?php $this->renderPartial('_popular', ['photos' => $salePhotos]); ?>
    </div>
</section>
<!-- End Product Area -->

<!-- Start Blog Area -->
<section class="htc__blog__area main__blog__area bg__white pb--70">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title text-center">
                    <h2 class="title__line">Наш блог</h2>
                    <p>#Новые статьи</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="ht__blog__wrap clearfix">
                <?php foreach($posts as $post) :?>
                    <!-- Start Single Blog -->
                    <div class="blog">
                        <div class="blog__thumb">
                            <a href="/blog/<?= $post->url ?>">
                                <img src="<?php echo $post->getImageUrl()?>" alt="<?= $post->title ?>">
                            </a>
                        </div>
                        <div class="blog__details">
                            <div class="bl__date">
                                <span><?= $this->dateFormat($post->date_create) ?></span>
                            </div>
                            <h2><a href="/blog/<?= $post->url ?>"><?= $post->title ?></a></h2>
                            <p><?= $post->description ?></p>
                            <div class="blog__btn">
                                <a href="/blog/<?= $post->url ?>"><i class="zmdi zmdi-long-arrow-right"></i>Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Blog -->
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!-- End Blog Area -->
