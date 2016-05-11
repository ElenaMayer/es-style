<?php foreach($model as $photo) :?>
    <div class="catalog__item">
        <div class="catalog__item__link">
            <?php if($photo->is_available) :?>
                <?php if($photo->is_sale) :?>
                    <span class="item__label">− <?= $photo->sale ?>%</span>
                <?php elseif($photo->is_new) :?>
                    <span class="item__label item__label_new_catalog">Новинка</span>
                <?php endif; ?>
            <?php endif; ?>
            <a href="/<?= $type ?>/<?= $photo->article ?>">
                <img class="catalog__item__img" src="<?= $photo->getPreviewUrl(); ?>" alt="Женская одежда, <?=$photo->title; ?> арт. <?= $photo->article; ?>">
                <div class="catalog__item__article">Арт.&nbsp;<?= $photo->article ?></div>
                <span class="price">
                    <?php if(!$photo->is_available) :?>
                        <span class="not_available_small">Нет в наличии</span>
                    <?php else :?>
                        <?php if(!$photo->is_sale) :?>
                            <?= $photo->price ?>&nbsp;руб.
                        <?php else :?>
                            <span class="price__old"><?= $photo->old_price ?>&nbsp;руб.</span>
                            <span class="price__new"><?= $photo->price ?>&nbsp;руб.</span>
                        <?php endif; ?>
                    <?php endif; ?>
                </span>
            </a>
            <?php if($photo->is_available) :?>
                <?php if($photo->size) :?>
                    <div class="size">
                        <span class="size_error__title">Укажите размер</span>
                        <?php $this->renderPartial('_sizes', array('model'=>$photo)); ?>
                    </div>
                <?php endif; ?>
                <span id="<?= $photo->id ?>" class="button button_big button_blue buy-button basket-button <?= $photo->size?'':'uni_size' ?>">
                    <i class="button__icon"></i>
                    <span class="button__progress"></span>
                </span>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
<div class="add_to_cart">
    <?php $this->renderPartial('cart/_cart_popup', array('cartItem' => [])); ?>
</div>

<script>

    $( '.catalog__item' ).on( 'click', '.buy-button', function() {
        $(".size.size_error").removeClass("size_error");
        $(".catalog__item__link.selected").removeClass("selected");
        if ($(this).parent('div').find(".button_pressed").length==0 && !$(this).hasClass("uni_size")){
            $(this).parent('.catalog__item__link').children('.size').addClass('size_error');
            $(this).parent('.catalog__item__link').addClass('selected');
        } else {
            addItemToCart($(this).attr('id'));
        }
    });

    $( '.catalog__item' ).on( 'click', '.size_button', function() {
        $(".catalog__item__link.selected").removeClass("selected");
        $(this).parents('.catalog__item__link').addClass('selected');
    });

    function addItemToCart(itemId) {
        $(this).addClass('button_in-progress').addClass('button_disabled').prop( "disabled", true );
        $.ajax({
                url: "/ajax/addToCart",
                data: {
                    item_id: itemId,
                    size: $(".button_pressed").text()
                },
                type: "POST",
                dataType : "html",
                success: function( data ) {
                    if (data) {
                        $('.add_to_cart').html(data);
                        jQuery('#add_to_cart').modal('show');
                        $('.button_in-progress').removeClass('button_in-progress').removeClass('button_disabled').prop( "disabled", false );
                        $(".catalog__item__link.selected").removeClass("selected");
                        $(".button.button_pressed").removeClass("button_pressed");
                    }
                }
            });
    }
</script>
