<div class="model">
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(/data/images/bg/model.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="/">Главная</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <a href="/<?= $type ?>" class="breadcrumb-item"><?= Yii::app()->params['categories'][$type] ?></a>
                            <?php if (isset($_GET['subcategory'])):?>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <span class="breadcrumb-item active"><?= Yii::app()->params['subcategories'][$type][$_GET['subcategory']] ?></span>
                            <?php endif; ?>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active"><?=$model->title?> арт. <?=$model->article?></span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Product Details Area -->
<section class="htc__product__details bg__white ptb--70">
    <!-- Start Product Details Top -->
    <div class="htc__product__details__top">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <div class="htc__product__details__tab__content">
                        <!-- Start Product Big Images -->
                        <div class="product__big__images">
                            <div class="portfolio-full-image tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                    <a href="<?= $model->getOriginalUrl(); ?>" class="MagicZoom" rel="zoom-height:475px; zoom-width:580px; hint: false;"><img src="<?= $model->getImageUrl(); ?>" alt="<?=$model->title; ?> арт. <?= $model->article; ?>"/></a>
                                </div>
                            </div>
                        </div>
                        <!-- End Product Big Images -->
                    </div>
                </div>
                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                    <div class="ht__product__dtl">
                        <h2><?= $model->title; ?></h2>
                        <h6>Арт. <span><?= $model->article; ?></span></h6>
                        <ul  class="pro__prize">
                            <?php if(!$model->is_available) :?>
                                <li class="not_available_small">Нет в наличии</li>
                            <?php else :?>
                                <?php if(Cart::isWholesale()) :?>
                                    <li><span class="red"><?= $model->wholesale_price ?>₽ ОПТ</span></li>
                                <?php else :?>
                                    <?php if(!$model->is_sale) :?>
                                        <li><?= $model->price ?>₽</li>
                                    <?php else :?>
                                        <li class="old__prize"><?= $model->old_price ?>₽</li>
                                        <li><?= $model->price ?>₽</li>
                                    <?php endif; ?>
                                    <div class="wholesale-price hide"><?= $model->wholesale_price ?>₽ </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                        <div class="ht__pro__desc">
                            <p class="pro__info"><?= $model->description; ?></p>
                            <div class="sin__desc align--left">
                                <p><span>Российский размер&nbsp;</span></p>
                                <?php if(!$model->size) :?>
                                    <span class="size__title"> (подходит на размеры <?= $model->size_at ?>-<?= $model->size_to ?>)&nbsp;</span>
                                    <a class="size__table-link" href="#" data-toggle="modal" data-target="#size_tab">Таблица размеров</a>
                                <?php else :?>
                                    <!-- For parser   -->
                                    <select class="select__size">
                                        <?php foreach ($model->sizesArr as $size): ?>
                                            <option><?= $size ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!-- /For parser   -->
                                    <div class="size__title">
                                        <a class="size__table-link" href="#" data-toggle="modal" data-target="#size_tab">Таблица размеров</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                            <?php if($model->is_available) :?>
                                <form method="post" class="add_to_cart">
                                    <input type="hidden" name="item_id" value="<?= $model->id ?>">
                                    <input type="hidden" name="product_action" id="product_action">
                                    <input type="hidden" name="size" id="product_size">
                                    <ul class="shopping__btn">
                                        <li><a class="add_to_cart_btn" id="cart">В корзину</a></li>
                                        <li class="shp__checkout"><a class="add_to_cart_btn" id="buy">Оформить заказ</a></li>
                                    </ul>
                                </form>
                            <?php endif;?>
                        <div class="ht__pro__other">
                            <div class="sin__desc product__share__link">
                                <ul class="pro__share">
                                    <?php $this->renderPartial('_social', ['model' => $model]); ?>
                                </ul>
                            </div>
                            <div class="sin__desc align--left">
                                <p><span>Категории</span></p>
                                <ul class="pro__cat__list">
                                    <?php foreach (explode(',',$model->subcategory) as $subcategory):?>
                                        <li><a href="#"><?= Yii::app()->params['subcategories'][$type][$subcategory];?></a></li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Details Top -->
</section>
<!-- End Product Details Area -->
<?php $this->renderPartial('_popular', ['photos' => $newPhotos]); ?>
<?php $this->renderPartial('_size_tab'); ?>
</div>

<script>
    $( '.ht__product__dtl' ).on( 'click', '.add_to_cart_btn', function($e) {

        var product_action = $(this).attr('id');
        var size = $('.select__size').val();
        $('#product_action').val(product_action);
        $('#product_size').val(size);

        yaCounter37654655.reachGoal('add_to_cart');
        ga('send', 'event', 'cart', 'add_to_cart');
        $('form.add_to_cart').submit();
    });
</script>