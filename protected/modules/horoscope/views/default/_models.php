<!-- Start Product Area -->
<section class="htc__product__area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title text--left">
                    <h2 class="title__line title__border">Подходящие модели</h2>
                    <p>#Тренды сезона</p>
                </div>
            </div>
        </div>
        <?php $currentUrl = Yii::app()->request->requestUri?>
        <div class="row">
            <div class="product__wrap activation__style--1 owl-carousel owl-theme clearfix">
                <?php foreach($models as $model) :?>
                    <?php $photo = $model->model?>
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
                                <?php if($photo->is_available) :?>
                                    <div class="product__hover__info">
                                        <form id="product_<?= $photo->id ?>" method="post" action="/other">
                                            <input type="hidden" name="item_id" value="<?= $photo->id ?>">
                                            <input type="hidden" name="product_action" id="product_action">
                                            <input type="hidden" name="page" value="<?= $currentUrl ?>">
                                            <input type="hidden" name="size" id="product_size">
                                            <?php if($photo->size) :?>
                                                <div class="sizes">
                                                    <?php $this->renderPartial('_sizes', array('model'=>$photo)); ?>
                                                </div>
                                            <?php endif; ?>
                                        </form>
                                    </div>
                                <?php endif; ?>
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

<script>
    $( '.sizes' ).on( 'click', '.size_button', function() {
        if(!<?=(Yii::app()->params['debugMode'])? 1 : 0 ?>)
            metrika();
        var size = $(this).text();
        $(this).parents('form').children('#product_size').val(size);
        $(this).parents('form').submit();
    });

    function metrika() {
        yaCounter37654655.reachGoal('add_to_cart');
        ga('send', 'event', 'cart', 'add_to_cart');
    }
</script>