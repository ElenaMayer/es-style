<div class="breadcrumbs">
    <a href="/" class="breadcrumbs__item">Главная</a>
    <a class="breadcrumbs__item" href="/<?=$type?>"><?=Yii::app()->params["categories"][$type]?></a>
    <span class="breadcrumbs__item"><?=$model->title?> арт. <?=$model->article?></span>
</div>
<div class="model">
    <div class="table__column table__column_left">
        <div class="table__table">
            <div class="table__cell_flat">
                <div class="model_photo">
                    <?php if($model->is_available) :?>
                        <?php if($model->is_sale) :?>
                            <span class="item__label">− <?= $model->sale ?>%</span>
                        <?php elseif($model->is_new) :?>
                            <span class="item__label item__label_new_catalog">Новинка</span>
                        <?php endif; ?>
                    <?php endif; ?>
                    <a href="<?= $model->getOriginalUrl(); ?>" class="MagicZoom" rel="zoom-height:475px; zoom-width:580px; hint: false;"><img src="<?= $model->getImageUrl(); ?>" alt="Женская одежда, <?=$model->title; ?> арт. <?= $model->article; ?>"/></a>
                </div>
            </div>
        </div>
    </div>
    <div class="table__column table__column_right">
        <div class="table__cell table__cell_flat">
            <div class="table__table">
                <div class="table__row">
                    <div class="model_header">
                        <h1 class="model_header__title"><?= $model->title; ?></h1>
                        <div class="model_header__title-article">Арт.&nbsp;<?= $model->article; ?></div>
                        <?php if(!$model->is_available) :?>
                            <div class="not_available">Нет в наличии</div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($model->is_available) :?>
                    <div class="table__row">
                        <div class="model_detail" >
                            <div class="model__price" >
                                <span class="price price_model">
                                    <?php if(!$model->is_sale) :?>
                                        <?= $model->price ?>&nbsp;руб.
                                    <?php else :?>
                                        <span class="price__old"><?= $model->old_price ?>&nbsp;руб.</span>
                                        <wbr>
                                        <span class="price__new"><?= $model->price ?>&nbsp;руб.</span>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="size">
                                <div class="size_error__title">Укажите размер</div>
                                <?php if(!$model->size) :?>
                                    <span class="size__title">Универсальный размер (подходит на размеры <?= $model->size_at ?>-<?= $model->size_to ?>)</span>
                                    <a class="size__table-link" href="#" data-toggle="modal" data-target="#size_tab">Таблица размеров</a>
                                <?php else :?>
                                    <div class="size__title">
                                        Российский размер
                                        <a class="size__table-link" href="#" data-toggle="modal" data-target="#size_tab">Таблица размеров</a>
                                    </div>
                                    <?php $this->renderPartial('_sizes', array('model'=>$model)); ?>
                                <?php endif; ?>
                            </div>
                            <div class="buy-widget__buy">
                                <span class="button button_big button_blue buy-button">
                                    <span class="button__title buy-button_title">
                                        Добавить в корзину
                                    </span>
                                    <span class="button__progress"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="table__row">
                    <div class="table__cell">
                        <?= $model->description; ?>
                    </div>
                </div>
                <div class="table__row">
                    <div class="table__cell social">
                        <div class="social-likes"  data-title="Женская одежда в восточном стиле">
                            <div class="twitter" title="Поделиться ссылкой в Твиттере">Twitter</div>
                            <div class="mailru" title="Поделиться ссылкой в Моём мире">Мой мир</div>
                            <div class="vkontakte" title="Поделиться ссылкой во Вконтакте">Вконтакте</div>
                            <div class="odnoklassniki" title="Поделиться ссылкой в Одноклассниках">Одноклассники</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->renderPartial('_size_tab'); ?>
<div class="add_to_cart">
    <?php $this->renderPartial('cart/_cart_popup', array('cartItem' => [])); ?>
</div>

<script>
    $( document ).ready(function() {
        $(".banner").show();
        if($(".sizes").length > 0 && $(".sizes").get(0).childElementCount == 1) {
            $('.size_button').addClass("button_pressed");
        }
    });
    $( '.model_detail' ).on( 'click', '.buy-button_title', function($e) {
        $(this).parent('span').addClass('button_in-progress').addClass('button_disabled').prop( "disabled", true );
        is_uni_size = <?= !empty($model->size) ? 0 : 1 ?>;
        if ($(".button_pressed").length==0 && !is_uni_size){
            $('.size').addClass('size_error');
        } else {
            $.ajax({
                url: "/ajax/addToCart",
                data: {
                    item_id: <?= $model->id; ?>,
                    size: $(".button_pressed").text()
                },
                type: "POST",
                dataType : "html",
                success: function( data ) {
                    if (data) {
                        $('.add_to_cart').html(data);
                        jQuery('#add_to_cart').modal('show');
                        $('.button_in-progress').removeClass('button_in-progress').removeClass('button_disabled').prop( "disabled", false );;
                    }
                }
            });
        }
    });
</script>