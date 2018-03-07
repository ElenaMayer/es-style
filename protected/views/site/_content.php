<?php foreach($model as $photo) :?>
    <!-- Start Single Product -->
    <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
        <div class="product">
            <div class="product__thumb">
                <a href="/<?= $photo->category ?>/<?= $photo->article . (isset($_GET['subcategory']) ? '?subcategory=' . $_GET['subcategory'] : '') ?>">
                    <img class="catalog__item__img lazy" data-original="<?= $photo->getImageUrl(); ?>" alt="<?=$photo->title; ?> арт. <?= $photo->article; ?>">
                    <noscript>
                        <img class="catalog__item__img" src="<?= $photo->getPreviewUrl(); ?>" alt="<?=$photo->title; ?> арт. <?= $photo->article; ?>">
                    </noscript>
                </a>
                <div class="product__offer">
                    <?php if($photo->is_available) :?>
                        <?php if($photo->is_sale && !Cart::isWholesale()) :?>
                            <span>-<?= $photo->sale ?>%</span>
                        <?php elseif($photo->is_new) :?>
                            <span class="new">Новинка</span>
                        <?php elseif($photo->is_hit && !Cart::isWholesale()) :?>
                            <span class="hit"><i class="icon-fire icons"></i></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php if($photo->is_available) :?>
                    <div class="product__hover__info">
                        <form id="product_<?= $photo->id ?>" method="post">
                            <ul class="product__action">
                                <li><a title="Купить" id="buy"><i class="icon-credit-card icons"></i></a></li>
                                <li><a title="В корзину" id="cart"><i class="icon-handbag icons"></i></a></li>
                            </ul>
                            <input type="hidden" name="item_id" value="<?= $photo->id ?>">
                            <input type="hidden" name="product_action" id="product_action">
                            <input type="hidden" name="size" id="product_size">
                            <?php if($photo->size) :?>
                                <div class="sizes hide">
                                    <?php $this->renderPartial('_sizes', array('model'=>$photo)); ?>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
            <div class="product__inner">
                <div class="product__details">
                    <h2><a href="/<?= $photo->category ?>/<?= $photo->article . (isset($_GET['subcategory']) ? '?subcategory=' . $_GET['subcategory'] : '') ?>"><?=$photo->title; ?></a></h2>
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
                                    <li class="old__prize"><?= $photo->old_price ?>₽</li>
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

<script>
    $(function() {
        $("img.lazy").show().lazyload({
            effect : "fadeIn"
        });
    });

    $( '.product__action' ).on( 'click', 'a', function() {
        var product_action = $(this).attr('id');
        var sizes = $(this).parents('.product__action').parent().children(".sizes");
        $(this).parents('.product__action').parent().children('#product_action').val(product_action);
        if(sizes.length > 0){
            $(this).parents('.product__action').addClass("hide");
            $(this).parents('.product__action').parent().children(".sizes").removeClass("hide");
        } else {
            metrika();
            $(this).parents('form').submit();
        }
    });

    $( '.sizes' ).on( 'click', '.size_button', function() {
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
