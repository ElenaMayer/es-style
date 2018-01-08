<div id="data" class="catalog">

    <div class="table__left-column">
        <div class="js-fix_side_block  catalog-navigation-wrap">
            <div class="catalog-navigation__title">Категории</div>
            <?php if(isset($_GET['subcategory'])):?>
                <input type="hidden" class="subcategory" value="<?= $_GET['subcategory']?>">
            <?php endif; ?>
            <ul class="catalog-navigation">
                <?php
                    $categories = Yii::app()->params['categories'];
                    if(Cart::isWholesale()) {
                        unset($categories['sale']);
                        unset($categories['hit']);
                    }
                ?>
                <?php foreach ($categories as $categoryId => $categoryName): ?>
                    <li class="catalog-navigation__item category__<?= $categoryId ?>">
                        <a class="catalog-navigation__link link <?php if($categoryId == $type):?> catalog-navigation__link_active<?php endif; ?>" href="/<?= $categoryId ?>"><?= $categoryName ?></a>
                        <span class="catalog-navigation__cnt"><?= Photo::model()->itemCountByCategory($categoryId) ?></span>
                        <?php if(isset(Yii::app()->params['subcategories'][$categoryId])):?>
                            <ul class="catalog-navigation catalog-navigation_subtree<?php if($categoryId != $type):?> hidden<?php endif; ?>">
                                <?php foreach (Yii::app()->params['subcategories'][$categoryId] as $subcategoryId => $subcategoryName): ?>
                                    <?php if (Photo::model()->itemCountBySubcategory($subcategoryId) > 0): ?>
                                        <li class="catalog-navigation__item">
                                            <a class="catalog-navigation__link link<?php if(isset($_GET['subcategory']) && $_GET['subcategory'] == $subcategoryId):?> catalog-navigation__link_active<?php endif; ?>" href="/<?= $categoryId ?>?subcategory=<?= $subcategoryId ?>"><?= $subcategoryName ?></a>
                                            <span class="catalog-navigation__cnt"><?= Photo::model()->itemCountBySubcategory($subcategoryId) ?></span>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif;?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="table__right-column">
        <div class="multi-wrapper js-multi-wrapper">
            <div class="products-catalog__head">
                <span class="products-catalog__sort">Сортировать:
                    <?php $this->widget('booster.widgets.TbButtonGroup', array(
                        'buttons'=>array(
                            array('label'=>Yii::app()->session['catalog_order'], 'items'=>Photo::model()->getOrderList($type)),
                        ),
                        'htmlOptions'=>array('class'=>'order_menu')
                    )); ?>
                </span>
                <div class="title">
                    <h2><?php if (isset($_GET['subcategory'])):?><?= Yii::app()->params['subcategories'][$type][$_GET['subcategory']] ?><?php else: ?><?= Yii::app()->params['categories'][$type] ?><?php endif; ?></h2>
                    <span class="products-catalog__head-counter"><?= $pagination->itemCount ?> товаров</span>
                </div>
            </div>
            <div class="js-multifilters-container" style="height: auto;">
                <div class="js-multifilters">
                    <div class="multifilters-new">
                        <span class="btn button_s button_wo-pdng-r multifilter-new__button-reset-all clear_filter<?php if(!$isFilter): ?> hidden<?php endif; ?>">Очистить фильтры</span>
                        <span class="multifilters-new__title">Фильтры:</span>
                        <?php $this->widget('booster.widgets.TbButtonGroup', array(
                            'buttons'=>array(
                                array('label'=>Yii::app()->session['catalog_size'] == 'все' ? 'Размер' : 'Размер: ' . Yii::app()->session['catalog_size'], 'items'=>Photo::getSizes()),
                            ),
                            'htmlOptions'=>Yii::app()->session['catalog_size'] == 'все' ? array('class'=>'size_menu') : array('class'=>'size_menu selected')
                        )); ?>
                        <?php $this->widget('booster.widgets.TbButtonGroup', array(
                            'buttons'=>array(
                                array('label'=>Yii::app()->session['catalog_color'] == 'все' ? 'Цвет' : 'Цвет: ' . Yii::app()->session['catalog_color'], 'items'=>Photo::model()->getColors()),
                            ),
                            'htmlOptions'=>Yii::app()->session['catalog_color'] == 'все' ? array('class'=>'color_menu') : array('class'=>'color_menu selected')
                        )); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="catalog__data">
            <?php if(empty($model)): ?>
                <div class="empty">К большому сожалению нет моделей соответствующих данным параметрам :(</div>
            <?php else: ?>
                <?php $this->renderPartial('_content', array('model'=>$model, 'type'=>$type)); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="site_pager">
        <?php $this->widget('CLinkPager', array(
            'pages' => $pagination,
            'header' => '',
            'nextPageLabel' => '>',
            'prevPageLabel' => '<',
            'firstPageLabel' => '<<',
            'lastPageLabel' => '>>',
            'maxButtonCount' => Yii::app()->params['maxPagerButtonCount']
        )); ?>
    </div>
</div>
<?php if(Yii::app()->params['show_catalog_banner']):?>
    <?php $this->renderPartial('_coupon_banner'); ?>
<?php endif;?>
<script>
    $( document ).ready(function() {
        $(".order_menu>ul.dropdown-menu>li").each(function( index ) {
            if ($(this).text().replace(/^\s+/, "") == '<?=Yii::app()->session['catalog_order']?>'.replace(/^\s+/, "")){
                $(this).addClass('active');
            }
        });
        $(".size_menu>ul.dropdown-menu>li").each(function( index ) {
            sizes = '<?=Yii::app()->session['catalog_size']?>';
            if (sizes.indexOf($(this).text().replace(/^\s+/, "")) >= 0){
                $(this).addClass('active');
            }
        });
        $(".color_menu>ul.dropdown-menu>li").each(function( index ) {
            color = '<?=Yii::app()->session['catalog_color']?>';
            if (color.indexOf($(this).text().replace(/^\s+/, "")) >= 0){
                $(this).addClass('active');
            }
        });
        if($('.subcategory').length > 0) {
            $(".yiiPager a").each(function( e ) {
                $(this).attr("href", $(this).attr("href") + '?subcategory=' + $('.subcategory').val());
            });
        }
    });
    $( ".order_menu>ul.dropdown-menu>li>a" ).click(function() {
        order = $(this).text();
        a = $(this);
        $.ajax({
            url: '/<?= $type?>',
            data: {
                order: order
            },
            type: "GET",
            dataType : "html",
            success: function( data ) {
                $('#data').html(data);
            }});
    });
    $( ".size_menu>ul.dropdown-menu>li>a" ).click(function() {
        size = $(this).text();
        a = $(this);
        $.ajax({
            url: '/<?= $type?>',
            data: {
                size: size
            },
            type: "GET",
            dataType : "html",
            success: function( data ) {
                $('#data').html(data);
            }});
    });
    $( ".color_menu>ul.dropdown-menu>li>a" ).click(function() {
        color = $(this).text();
        a = $(this);
        $.ajax({
            url: '/<?= $type?>',
            data: {
                color: color
            },
            type: "GET",
            dataType : "html",
            success: function( data ) {
                $('#data').html(data);
            }});
    });
    $( ".clear_filter" ).click(function() {
        $.ajax({
            url: '/<?= $type?>',
            data: {
                color: 'все',
                size: 'все'
            },
            type: "GET",
            dataType : "html",
            success: function( data ) {
                $('#data').html(data);
            }});
    });
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() == $(document).height()) {
            $.ajax({
                url: '/ajax/bannerHasShowed',
                type: "GET",
                dataType : "html",
                success: function( data ) {
                    if(data == 1){
                        jQuery('#coupon_banner').modal('show');
                    }
                }});
        }
    });
</script>