<div id="data" class="catalog">

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(/data/images/bg/4.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner">
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="/">Главная</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <?php if (isset($_GET['subcategory'])):?>
                                    <a href="/<?= $type ?>" class="breadcrumb-item"><?= Yii::app()->params['categories'][$type] ?></a>
                                    <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                    <span class="breadcrumb-item active"><?= Yii::app()->params['subcategories'][$type][$_GET['subcategory']] ?></span>
                                <?php else: ?>
                                    <span class="breadcrumb-item active"><?= Yii::app()->params['categories'][$type] ?></span>
                                <?php endif; ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Product Grid -->
    <section class="htc__product__grid bg__white ptb--70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="htc__product__leftsidebar">
                        <h2 class="title__line--3">Фильтр</h2>
                        <!-- Start Category Area -->
                        <div class="htc__category">
                            <h4 class="title__line--4">По категории</h4>
                            <?php if(isset($_GET['subcategory'])):?>
                                <input type="hidden" class="subcategory" value="<?= $_GET['subcategory']?>">
                            <?php endif; ?>
                            <?php
                            $categories = Yii::app()->params['categories'];
                            if(Cart::isWholesale()) {
                                unset($categories['sale']);
                                unset($categories['hit']);
                            }
                            ?>
                            <ul class="ht__cat__list">
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
                        <!-- End Category Area -->
                        <!-- Start Prize Range -->
                        <div class="htc-grid-range">
                            <h4 class="title__line--4">По цене</h4>
                            <div class="content-shopby">
                                <div class="price_filter s-filter clear">
                                    <form action="#" method="GET">
                                        <div id="slider-range"></div>
                                        <div class="slider__range--output">
                                            <div class="price__output--wrap">
                                                <div class="price--output">
                                                    <span>Цена :</span><input type="text" id="amount" readonly>
                                                </div>
                                                <div class="price--filter">
                                                    <a href="#">Найти</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Prize Range -->
                        <!-- Start Pro Color -->
                        <div class="ht__pro__color">
                            <h4 class="title__line--4">По цвету</h4>
                            <ul class="ht__color__list">
                                <li class="all"><a href="#" title="все">все</a></li>
                                <li class="black"><a href="#" title="черный">черный</a></li>
                                <li class="white"><a href="#" title="белый">белый</a></li>
                                <li class="red"><a href="#" title="красный">красный</a></li>
                                <li class="grey"><a href="#" title="серый">серый</a></li>
                                <li class="pink"><a href="#" title="розовый">розовый</a></li>
                            </ul>
                            <ul class="ht__color__list">
                                <li class="blue"><a href="#" title="синий">синий</a></li>
                                <li class="green"><a href="#" title="зеленый">зеленый</a></li>
                                <li class="lamon"><a href="#" title="бежевый">бежевый</a></li>
                                <li class="yellow"><a href="#" title="желтый">желтый</a></li>
                                <li class="broun"><a href="#" title="коричневый">коричневый</a></li>
                                <li class="orange"><a href="#" title="оранжевый">оранжевый</a></li>
                            </ul>
                        </div>
                        <!-- End Pro Color -->
                        <!-- Start Pro Size -->
                        <div class="ht__pro__size">
                            <h4 class="title__line--4">По размеру</h4>
                            <ul class="ht__size__list">
                                <li class="all"><a href="#" title="все">все</a></li>
                                <li><a href="#" title="40">40</a></li>
                                <li><a href="#" title="42">42</a></li>
                                <li><a href="#" title="44">44</a></li>
                                <li><a href="#" title="46">46</a></li>
                            </ul>
                            <ul class="ht__size__list">
                                <li><a href="#" title="48">48</a></li>
                                <li><a href="#" title="50">50</a></li>
                                <li><a href="#" title="52">52</a></li>
                                <li><a href="#" title="54">54</a></li>
                                <li><a href="#" title="56">56</a></li>
                            </ul>
                        </div>
                        <!-- End Pro Size -->
                        <!-- Start Best Sell Area -->
                        <div class="htc__recent__product">
                            <h2 class="title__line--3">Популярное</h2>
                            <div class="htc__recent__product__inner">
                                <?php foreach ($modelHits as $hit):?>
                                    <!-- Start Single Product -->
                                    <div class="htc__best__product">
                                        <div class="htc__best__pro__thumb">
                                            <a href="/<?= $hit->category ?>/<?= $hit->article?>">
                                                <img src="<?= $hit->getPreviewUrl(); ?>" alt="<?=$hit->title; ?> арт. <?= $hit->article; ?>">
                                            </a>
                                        </div>
                                        <div class="htc__best__product__details">
                                            <h2><a href="/<?= $hit->category ?>/<?= $hit->article?>"><?=$hit->title; ?></a></h2>
                                            <ul  class="pro__prize">
                                                <?php if(Cart::isWholesale()) :?>
                                                    <li><?= $hit->wholesale_price ?>₽ <span class="red">ОПТ</span></li>
                                                <?php else :?>
                                                    <?php if(!$hit->is_sale) :?>
                                                        <li><?= $hit->price ?>₽ <span>(РОЗНИЦА)</span></li>
                                                    <?php else :?>
                                                        <li class="old__prize"><?= $hit->old_price ?>₽</li>
                                                        <li><?= $hit->price ?>₽</li>
                                                        <li>(РОЗН)</li>
                                                    <?php endif; ?>
                                                    <div class="wholesale-price hide"><?= $hit->wholesale_price ?>₽ </div>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- End Single Product -->
                                <?php endforeach;?>
                            </div>
                        </div>
                        <!-- End Best Sell Area -->
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12 smt-40 xmt-40">
                    <div class="htc__product__rightidebar">
                        <div class="htc__grid__top">
                            <div class="ht__pro__qun">
                                <span>Товары <?= ($pagination->currentPage+1)*$pagination->pageSize-$pagination->pageSize+1 ?>-<?= ($pagination->currentPage+1)*$pagination->pageSize ?> из <?= $pagination->itemCount ?></span>
                            </div>
                            <span class="products-catalog__sort">
                                Сортировать:
                                <?php $this->widget('booster.widgets.TbButtonGroup', array(
                                    'buttons'=>array(
                                        array('label'=>Yii::app()->session['catalog_order'], 'items'=>Photo::model()->getOrderList($type)),
                                    ),
                                    'htmlOptions'=>array('class'=>'order_menu')
                                )); ?>
                            </span>
                        </div>
                        <!-- Start Product View -->
                        <div class="row">
                            <div class="shop__grid__view__wrap">
                                <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                    <?php if(empty($model)): ?>
                                        <div class="empty">К большому сожалению нет моделей соответствующих данным параметрам :(</div>
                                    <?php else: ?>
                                        <?php $this->renderPartial('_content', array('model'=>$model, 'type'=>$type)); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- End Product View -->
                    </div>
                    <!-- Start Pagenation -->
                    <div class="row">
                        <div class="col-xs-12">
                            <?php $this->widget('CLinkPager', array(
                                'pages' => $pagination,
                                'header' => '',
                                'nextPageLabel' => '>',
                                'prevPageLabel' => '<',
                                'firstPageLabel' => '<<',
                                'lastPageLabel' => '>>',
                                'selectedPageCssClass' => 'active',
                                'maxButtonCount' => Yii::app()->params['maxPagerButtonCount'],
                                'htmlOptions' => array('class' => 'htc__pagenation'),
                            )); ?>
                        </div>
                    </div>
                    <!-- End Pagenation -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Grid -->
</div>
<?php if(Yii::app()->params['show_catalog_banner']):?>
    <?php $this->renderPartial('_coupon_banner'); ?>
<?php endif;?>
<script>
    $( document ).ready(function() {
//        $(".order_menu>ul.dropdown-menu>li").each(function( index ) {
//            if ($(this).text().replace(/^\s+/, "") == '<?//=Yii::app()->session['catalog_order']?>//'.replace(/^\s+/, "")){
//                $(this).addClass('active');
//            }
//        });
//        $(".size_menu>ul.dropdown-menu>li").each(function( index ) {
//            sizes = '<?//=Yii::app()->session['catalog_size']?>//';
//            if (sizes.indexOf($(this).text().replace(/^\s+/, "")) >= 0){
//                $(this).addClass('active');
//            }
//        });
//        $(".color_menu>ul.dropdown-menu>li").each(function( index ) {
//            color = '<?//=Yii::app()->session['catalog_color']?>//';
//            if (color.indexOf($(this).text().replace(/^\s+/, "")) >= 0){
//                $(this).addClass('active');
//            }
//        });
//        if($('.subcategory').length > 0) {
//            $(".yiiPager a").each(function( e ) {
//                $(this).attr("href", $(this).attr("href") + '?subcategory=' + $('.subcategory').val());
//            });
//        }
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
    $( ".ht__pro__size>ul.ht__size__list>li>a" ).click(function() {
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
    $( ".ht__pro__color>ul.ht__color__list>li>a" ).click(function() {
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
//    $( ".clear_filter" ).click(function() {
//        $.ajax({
//            url: '/<?//= $type?>//',
//            data: {
//                color: 'все',
//                size: 'все'
//            },
//            type: "GET",
//            dataType : "html",
//            success: function( data ) {
//                $('#data').html(data);
//            }});
//    });
//    $(window).scroll(function() {
//        if($(window).scrollTop() + $(window).height() == $(document).height()) {
//            $.ajax({
//                url: '/ajax/bannerHasShowed',
//                type: "GET",
//                dataType : "html",
//                success: function( data ) {
//                    if(data == 1){
//                        jQuery('#coupon_banner').modal('show');
//                    }
//                }});
//        }
//    });
</script>