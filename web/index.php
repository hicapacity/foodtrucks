<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/../protected/config/main.php';

if ($_SERVER['HTTP_HOST'] !== 'www.streetgrindz.com'
    && $_SERVER['HTTP_HOST'] !== 'streetgrindz.com') {
        defined('YII_DEBUG') or define('YII_DEBUG',true);
        defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
}
require_once($yii);
Yii::createWebApplication($config)->run();
