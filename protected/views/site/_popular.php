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
        <div class="row">
            <div class="product__wrap activation__style--1 owl-carousel owl-theme clearfix">
                <?php foreach($photos as $photo) :?>
                    <!-- Start Single Product -->
                    <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                        <div class="product">
                            <div class="product__thumb">
                                <a href="/<?= $photo->category ?>/<?= $photo->article . (isset($_GET['subcategory']) ? '?subcategory=' . $_GET['subcategory'] : '') ?>">
                                    <img src="<?= $photo->getImageUrl(); ?>" alt="<?=$photo->title; ?> арт. <?= $photo->article; ?>">
                                </a>
                                <div class="product__offer">
                                    <?php if($photo->is_sale && !Cart::isWholesale()) :?>
                                        <span>-<?= $photo->sale ?>%</span>
                                    <?php elseif($photo->is_new) :?>
                                        <span class="new">Новинка</span>
                                    <?php elseif($photo->is_hit && !Cart::isWholesale()) :?>
                                        <span class="hit"><i class="icon-fire icons"></i></span>
                                    <?php endif; ?>
                                </div>
                                <div class="product__hover__info">
                                    <ul class="product__action">
                                        <li><a href="/chackout"><i class="icon-credit-card icons"></i></a></li>
                                        <li><a href="/cart"><i class="icon-handbag icons"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product__inner">
                                <div class="product__details">
                                    <h2><a href="product-details.html"><?= $photo->title ?></a></h2>
                                    <ul  class="pro__prize">
                                        <?php if(!$photo->is_available) :?>
                                            <li class="not_available_small">Нет в наличии</li>
                                        <?php else :?>
                                            <?php if(Cart::isWholesale()) :?>
                                                <li><?= $photo->wholesale_price ?>₽ <span class="red">ОПТ</span></li>
                                            <?php else :?>
                                                <?php if(!$photo->is_sale) :?>
                                                    <li><?= $photo->price ?>₽</li>
                                                <?php else :?>
                                                    <li class="old__prize"><?= $photo->old_price ?>&nbsp;₽</li>
                                                    <li><?= $photo->price ?>₽</li>
                                                <?php endif; ?>
                                                <div class="wholesale-price hide"><?= $photo->wholesale_price ?>₽ </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Product -->
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!-- End Product Area -->