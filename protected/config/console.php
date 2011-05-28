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
    'params' => array(
        'twitter'=>array(
            'consumerKey'=>'oTAiNpbW0mYHrL3PscA',
            'consumerSecret'=>'qHLtP0F0z4hRfcgMM7JgGyr4lbiH3j9WJH9GwIXgAA',
            'oauthAccessToken'=>'302857632-Hd7yGOZ2kA8qCFvlWm6liSGl3H0Ibh4BZ0Ez0auO',
            'oauthAccessTokenSecret'=>'tRUtieBnPqZ3SaZsHxIzxv0FQTSoleyZtFkAm6kJ7O0',
        ),
    ),
);
