<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$settingsMain = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Organization Name of City, State',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'ext.yii-mail.YiiMailMessage',         
	),

	'modules'=>array(

	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
            'appendParams' => true,
            'showScriptName' => false,            
			//'rules'=>array(
			//	'<controller:\w+>/<id:\d+>'=>'<controller>/view',
			//	'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
			//	'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			//),
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=streetgrindzapp',  //set db name
			'emulatePrepare' => true,
			'username' => 'streetgrindzuser',  //set username
			'password' => 'dev',  //set password
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
 		'mail' => array(
 			'class' => 'ext.yii-mail.YiiMail',
 			'transportType' => 'php',
 			'viewPath' => 'application.views',
 			'logging' => true,
 			'dryRun' => false
 		),         
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'admin@mydomain.com',
		'contactEmail'=>'contact@mydomain.com',
	),
);

if ($_SERVER['HTTP_HOST'] === 'www.myurl.com' || $_SERVER['HTTP_HOST'] === 'myurl.com') {
    $settingsMain['components']['log']['routes'][] =
        array(
            'class' => 'CEmailLogRoute',
            'levels' => 'error, warning',
            'emails' => 'error@mydomain.com',
        );
} else {
    $settingsMain['components']['log']['routes'][] =
        array(
            'class' => 'CWebLogRoute',
            'levels' => 'error, warning',
        );
    $settingsMain['modules']['gii'] =
        array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
            'ipFilters' =>
            array(
                '192.168.1.100',
                '192.168.1.101',  /// SET IP's for dev machine here
                '192.168.1.110'
            )
        );
}
return $settingsMain;
