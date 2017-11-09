<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />
    <meta name="description" content="Интернет-магазин женской одежды в восточном стиле. Платья, блузки, кимоно и домашняя одежда. Индивидуальный восточный гороскоп."/>
    <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>

    <?php Yii::app()->clientScript->registerScriptFile('/js/common.js?2', CClientScript::POS_HEAD) ?>
    <?php Yii::app()->clientScript->registerScriptFile('/js/magiczoom.js', CClientScript::POS_HEAD) ?>
    <?php Yii::app()->clientScript->registerScriptFile('/js/social-likes.min.js', CClientScript::POS_HEAD) ?>
    <?php Yii::app()->clientScript->registerScriptFile('/js/jquery_lazyload-1.9.3/jquery.lazyload.js', CClientScript::POS_HEAD) ?>
    <?php Yii::app()->clientScript->registerScriptFile('/js/bootstrap-filestyle.min.js', CClientScript::POS_HEAD) ?>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/site.css?29" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/auth.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/magiczoom.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/social-likes_flat.css" />
    <?php if (strpos(Yii::app()->request->pathInfo, 'blog')!==false):?>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/blog.css?4" />
    <?php endif;?>
    <?php if (strpos(Yii::app()->request->pathInfo, 'horoscope')!==false):?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/horoscope.css?6" />
    <?php endif;?>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter37654655 = new Ya.Metrika({ id:37654655, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/37654655" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
    <!-- GoogleAnalytics -->
    <script async>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-55669537-1', 'auto');
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
    </script>
    <!-- /GoogleAnalytics -->
</head>

<body class="main">
    <div class="page">
        <div class="header">
            <div class="header__content">
                <a href="/" class="header__logo"></a>
                <!--a href="/" class="header__logo" style="top: 85px;"></a-->
                <div class="header__inner">
                    <div class="header__contact">
                        <div class="header__contact_item">
                            <i class="header__phone-icon"></i>
                            <?= Yii::app()->params['phone'] ?>
                        </div>
                    </div>
                    <div class="user-nav user-nav_signed">
                        <a class="basket-button button button_blue button_big"  href="/cart/">
                            <span class="button__title<?php if (Yii::app()->user->isGuest):?> guest-basket-button<?php endif; ?>">
                                <i class="button__icon"></i>
                                <span class="basket-button-title"><?php if(isset(Yii::app()->cart->currentCart->count) && Yii::app()->cart->currentCart->count > 0):?>(<?= Yii::app()->cart->currentCart->count; ?>)<?php endif?></span>
                            </span>
                        </a>
                        <div class="user-nav__sign-in">
                            <?php if (!Yii::app()->user->isGuest):?>
                                <a class="user-nav__user button button_big button_left" href="/customer/">
                                    <i class="button__icon"></i>
                                </a>
                            <?php endif;?>
                            <div id='auth_buttons' class="user-nav__prefs button-dropdown">
                                <?php if (Yii::app()->user->isGuest):?>
                                    <a class="button button_big button_icon button_right" href="#" data-toggle="modal" data-target="#auth_form">
                                        <span class="button__title">Вход</span>
                                    </a>
                                <?php else: ?>
                                    <a class="button button_big button_icon button_right">
                                        <span class="button__title logout">Выход</span>
                                    </a>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner">
                <a href="<?= Yii::app()->params['bannerUrl'] ?>">
                    <img src="/data/i/banner.png?4">
                </a>
            </div>
            <?php
                $this->widget(
                    'booster.widgets.TbNavbar',
                    array(
                        'brand' => false,
                        'fixed' => false,
                        'fluid' => true,
                        'htmlOptions'=>array('class'=>'menu'),
                        'items' => array(
                            array(
                                'class' => 'booster.widgets.TbMenu',
                                'type' => 'navbar',
                                'htmlOptions'=>array('class'=>'menu__list'),
                                'items' => array(
                                    array('label' => 'Платья', 'url' => '/dress', 'active'=>strpos(Yii::app()->request->pathInfo, 'dress')===false? false:true),
                                    array('label' => 'Блузки', 'url' => '/blouse', 'active'=>strpos(Yii::app()->request->pathInfo, 'blouse')===false? false:true),
                                    array('label' => 'Кимоно', 'url' => '/kimono', 'active'=>strpos(Yii::app()->request->pathInfo, 'kimono')===false? false:true),
                                    array('label' => 'Разное', 'url' => '/other', 'active'=>strpos(Yii::app()->request->pathInfo, 'other')===false? false:true),
//                                    array('label' => 'Статьи', 'url' => '/blog', 'active'=>strpos(Yii::app()->request->pathInfo, 'blog')===false? false:true),
                                    array('label' => 'Гороскоп', 'url' => '/horoscope', 'active'=>strpos(Yii::app()->request->pathInfo, 'horoscope')===false? false:true),
                                    array('label' => 'Отзывы', 'url' => '/reviews', 'active'=>strpos(Yii::app()->request->pathInfo, 'reviews')===false? false:true),
                                )
                            )
                        )
                    )
                );
            ?>
        </div><!-- header -->
        <?php if(isset($this->breadcrumbs)):?>
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
            )); ?><!-- breadcrumbs -->
        <?php endif;?>
        <div class="content">
            <?php if(!Cart::isWholesale()):?>
                <?php $this->renderPartial('application.views.site._horoscope_popup'); ?>
            <?php endif;?>
            <?php echo $content; ?>
        </div>
        <div class="footer_with_menu">
            <div class="footer-menu">
                <div class="footer__column">
                    <h1>О нас</h1>
                    <a href="/about/contact">Контакты</a>
                    <a href="/about/wholesale">Оптом</a>
                    <a href="/about/offer">Публичня оферта</a>
                </div>
                <div class="footer__column">
                    <h1>Помощь</h1>
                    <a href="/about/order">Как сделать заказ</a>
                    <a href="/about/shipping">Информация о доставке</a>
                    <a href="/about/payment">Способы оплаты</a>
                    <a href="/about/refund">Возврат товара</a>
                    <a href="/about/sizes">Как выбрать размер</a>
                </div>
                <div class="footer__column last_column">
                    <h1>Мы в соцсетях</h1>
                    <div class="header__contact_item">
                        <a target="_blank" class="header__social-item header__social-item_vk" href="<?=Yii::app()->params['vkontakteLink']?>"></a>
                        <a target="_blank" class="header__social-item header__social-item_ig" href="<?=Yii::app()->params['instagramLink']?>"></a>
                        <a target="_blank" class="header__social-item header__social-item_ok" href="<?=Yii::app()->params['odnoklassnikiLink']?>"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div><!-- page -->
    <div class="getprice">
        <a href="site/price">Скачать прайс</a>
    </div>
    <div class="footer">
        Copyright &copy; 2014 - 2017 by <?php echo Yii::app()->params['domain']; ?>.<br/>
        All Rights Reserved.<br/>
    </div><!-- footer -->
    <?php $this->renderPartial('application.views.site.auth._auth', array('modelAuth'=>new User('registration'))); ?>

    <!-- Код тега ремаркетинга Google -->
    <!--------------------------------------------------
    С помощью тега ремаркетинга запрещается собирать информацию, по которой можно идентифицировать личность пользователя. Также запрещается размещать тег на страницах с контентом деликатного характера. Подробнее об этих требованиях и о настройке тега читайте на странице http://google.com/ads/remarketingsetup.
    --------------------------------------------------->
    <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 976913656;
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = true;
        /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/976913656/?guid=ON&amp;script=0"/>
        </div>
    </noscript>

</body>
<script>
    $( "#auth_buttons" ).on( "click", ".logout", function() {
        $.ajax({
            url: "/site/logout",
            success: function( data ) {
                window.location.reload();
            }});
    });
</script>
</html>
