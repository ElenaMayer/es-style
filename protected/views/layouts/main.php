<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />
    <meta name="description" content="Одежда восточный стиль, женская одежда восточный стиль, женская одежда оптом"/>
    <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>

    <?php Yii::app()->clientScript->registerScriptFile('/js/common.js', CClientScript::POS_HEAD) ?>
    <?php Yii::app()->clientScript->registerScriptFile('/js/magiczoom.js', CClientScript::POS_HEAD) ?>
    <?php Yii::app()->clientScript->registerScriptFile('/js/social-likes.min.js', CClientScript::POS_HEAD) ?>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/site.css?1" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/auth.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/magiczoom.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/social-likes_flat.css" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter10311718 = new Ya.Metrika({id:10311718, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/10311718" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
    <!-- GoogleAnalytics -->
    <script async>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-55669537-1', 'auto');
        ga('send', 'pageview');
    </script>
    <!-- /GoogleAnalytics -->
</head>

<body class="main">
    <div class="page">
        <div class="header">
            <!--div style="
                    background-color: white;
                    padding: 13px;
                    color: rgb(207, 30, 25);
                    font-size: 18px;">
                Дорогие покупатели! Временно не будет </br>осуществляться прием и отправка оптовых заказов с <strong>1 по 8 июля</strong>. Спасибо за понимание!
            </div-->
            <div class="header__content">
                <a href="/" class="header__logo"></a>
                <!--a href="/" class="header__logo" style="top: 85px;"></a-->
                <div class="header__inner">
                    <div class="header__contact">
                        <div class="header__contact_item">
                            <i class="header__phone-icon"></i>
                            <?= Yii::app()->params['phone'] ?>
                        </div>
                        <div class="header__contact_item_right">
                            Мы в соцсетях:
                            <a target="_blank" class="header__social-item header__social-item_vk" href="<?=Yii::app()->params['vkontakteLink']?>"></a>
                            <a target="_blank" class="header__social-item header__social-item_ig" href="<?=Yii::app()->params['instagramLink']?>"></a>
                            <a target="_blank" class="header__social-item header__social-item_ok" href="<?=Yii::app()->params['odnoklassnikiLink']?>"></a>
                        </div>
                    </div>
                    <div class="user-nav user-nav_signed">
                        <a class="basket-button button button_blue button_big"  href="/cart/">
                            <span class="button__title">
                                <i class="button__icon"></i>
                                <span class="basket-button-title">Моя корзина <?php if(isset($this->cart->count) && $this->cart->count > 0):?>(<?= $this->cart->count; ?>)<?php endif?></span>
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
                                    array('label' => 'Адреса', 'url' => '/contact', 'active'=>strpos(Yii::app()->request->pathInfo, 'contact')===false? false:true),
                                    array('label' => 'В розницу', 'url' => '/shipping', 'active'=>strpos(Yii::app()->request->pathInfo, 'shipping')===false? false:true),
                                    array('label' => 'Оптом', 'url' => '/wholesale', 'active'=>strpos(Yii::app()->request->pathInfo, 'wholesale')===false? false:true),
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
            <?php echo $content; ?>
        </div>
        <div class="clear"></div>
    </div><!-- page -->
    <div class="footer">
        Copyright &copy; <?php echo date('Y'); ?> by es-style.ru.<br/>
        All Rights Reserved.<br/>
    </div><!-- footer -->
    <?php $this->renderPartial('_auth', array('modelAuth'=>new User)); ?>
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
