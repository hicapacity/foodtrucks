<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$settingsMain = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Streetgrindz',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
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
			'rules'=>array(
				//'api/trucks'=>'api/all_trucks',
				//'api/raise_exception'=>'api/raise_exception',
				//'api/truck/<id:\d+>'=>'api/truck_by_id',
			),
		),
		
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
	'params' => require( dirname( __FILE__ ) . '/params.php' ),
);


// TODO: Need to have separate configuration files for production/dev
if ($_SERVER['HTTP_HOST'] === 'www.streetgrindz.com' || $_SERVER['HTTP_HOST'] === 'streetgrindz.com') {
    $settingsMain['components']['log']['routes'][] =
    array(
        'class' => 'CEmailLogRoute',
        'levels' => 'error, warning',
        'emails' => 'maker@hicapacity.org',
    );
} else {
    $settingsMain['components']['log']['routes'][] =
    array(
        'class' => 'CWebLogRoute',
        //'levels' => 'trace, info, error, warning',
        'levels' => 'error, warning',
    );
    $settingsMain['modules']['gii'] =
    array(
        'class' => 'system.gii.GiiModule',
        'password' => 'admin',
        'ipFilters' => array(
            '127.0.0.1',
            '192.168.1.100',
            '192.168.1.101',
            '192.168.1.102',
            '192.168.1.103',
            '192.168.1.104',
            '192.168.1.105',
            '192.168.1.106',
            '192.168.1.107',
            '192.168.1.108',
            '192.168.1.109',
            '192.168.1.110'
        ),        
    );
}
return $settingsMain;
