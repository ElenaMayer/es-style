<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),
	// application components
	'components'=>array(
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=es-style',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '1q2w3e',
            'charset' => 'utf8',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
        'userForMail'=>[
            'class'=>'UserForMail'
        ],
	),
    'params'=>array_merge(array(
            'phone' => 'phone',
            'email' => 'email@gmail.com',
            'emailTo' => 'email@gmail.com',
            'emailFrom' => 'email@gmail.com',
            'domain' => 'es-style.ru',
        ), require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'params.php'))
);