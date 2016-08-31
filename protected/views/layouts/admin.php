<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon_admin.ico" type="image/x-icon"/>
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin.css" />

	<title>Админка <?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container">

	<div id="header">
		<div id="logo"><b>Админка</b> <?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Главная', 'url'=>'/admin/index', 'active'=>strpos(Yii::app()->request->pathInfo, 'admin/index')===false? false:true, 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Галерея', 'url'=>'/admin/photo/index', 'active'=>strpos(Yii::app()->request->pathInfo, 'photo')===false? false:true, 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Новости', 'url'=>'/admin/news/index', 'active'=>strpos(Yii::app()->request->pathInfo, 'news')===false? false:true, 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Заказы розница', 'url'=>'/admin/orderHistory/index', 'active'=>strpos(Yii::app()->request->pathInfo, 'orderHistory')===false? false:true, 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Заказы опт', 'url'=>'/admin/order', 'active'=>preg_match('/order$/', Yii::app()->request->pathInfo)===1? true:false, 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Прайсы', 'url'=>'/admin/price', 'active'=>strpos(Yii::app()->request->pathInfo, 'price')===false? false:true, 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Пользователи', 'url'=>'/admin/user/index', 'active'=>strpos(Yii::app()->request->pathInfo, 'user')===false? false:true, 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Мэйл лог', 'url'=>'/admin/mailLog', 'active'=>strpos(Yii::app()->request->pathInfo, 'mailLog')===false? false:true, 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'UTM метки', 'url'=>'/admin/utmLog', 'active'=>strpos(Yii::app()->request->pathInfo, 'utmLog')===false? false:true, 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Вход', 'url'=>'/admin/login', 'visible'=>Yii::app()->user->isGuest, 'active'=>strpos(Yii::app()->request->pathInfo, 'login')===false? false:true),
				array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>'/admin/logout', 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by <?php echo Yii::app()->params['domain']; ?>.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
