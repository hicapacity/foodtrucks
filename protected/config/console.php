<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
	// application components
	'components'=>array(
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
	),

	'import'=>array(
		'application.components.*',
    ),

    // Food truck config
	'params' => array(
        'trucks' => require( dirname( __FILE__ ) . '/foodtruck.php' ),
    ),
);
