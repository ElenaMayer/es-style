<?php

$backendConfigDir = dirname(__FILE__);
$root = $backendConfigDir.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..';

Yii::setPathOfAlias('root', $root);
Yii::setPathOfAlias('data', $root.DIRECTORY_SEPARATOR.'data');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Одежда Восточный Стиль',
    'language' => 'ru',

	'preload'=>array('log', 'booster'),

	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.extensions.*',
	),

	'modules'=>array(

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
        'booster' => [
            'class' => 'ext.booster.components.Booster',
        ],
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                'admin/<controller:\w+>/<action:\w+>/' => '<controller>/<action>/',
                'admin/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>/',
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=es_style',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '1q2w3e',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
        'image'=>array(
            'class'=>'CImageHandler',
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
        'mainPhone' => '+7-952-929-8710',
        'categories' => array(
            1 => 'Платья',
            2 => 'Блузки',
            3 => 'Кимоно',
            4 => 'Костюмы',
            5 => 'Халаты',
            6 => 'Мужское',
            7 => 'Детское',
            8 => 'Разное',
        ),
    ),
);