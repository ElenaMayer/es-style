<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/site.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="main">

    <div class="page">
        <div class="header">
            <div class="header__content">
                <a href="/" class="header__logo"></a>
                <div class="header__inner">
                    <div class="header__phone">
                        <i class="header__phone-icon"></i>
                        <?= Yii::app()->params['mainPhone'] ?>
                    </div>
                    <div class="header__socials">
                        Мы в соцсетях:
                        <a target="_blank" class="header__social-item header__social-item_vk" href="http://vk.com/club54656176"></a>
                        <a target="_blank" class="header__social-item header__social-item_ok" href="http://odnoklassniki.ru/profile/549921469407"></a>
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
                                    array('label' => 'Платья', 'url' => 'dress', 'active'=>strpos(Yii::app()->request->pathInfo, 'dress')===false? true:true),
                                    array('label' => 'Блузки', 'url' => 'blouse', 'active'=>strpos(Yii::app()->request->pathInfo, 'blouse')===false? false:true),
                                    array('label' => 'Кимоно', 'url' => 'kimono', 'active'=>strpos(Yii::app()->request->pathInfo, 'kimono')===false? false:true),
                                    array('label' => 'Разное', 'url' => 'other', 'active'=>strpos(Yii::app()->request->pathInfo, 'other')===false? false:true),
                                    array('label' => 'Контакты', 'url' => 'contact', 'active'=>strpos(Yii::app()->request->pathInfo, 'contact')===false? false:true),
                                    array(
                                        'label' => 'Заказать',
                                        'htmlOptions'=>array('class'=>'menu__dropdown'),
                                        'items' => array(
                                            array('label' => 'Оптом', 'url' => 'wholesale'),
                                            array('label' => 'В рознцу', 'url' => 'shiping')
                                        )
                                    ),
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
        <?php endif?>
        <div class="content">
            <?php echo $content; ?>
        </div>

        <div class="clear"></div>

        <div class="footer">
            Copyright &copy; <?php echo date('Y'); ?> by es-style.ru.<br/>
            All Rights Reserved.<br/>
        </div><!-- footer -->

    </div><!-- page -->

</body>
</html>
