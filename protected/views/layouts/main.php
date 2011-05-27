<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<!-- Using same css for now since we're targeting devices -->	
	<link rel="stylesheet" media='only screen and (max-device-width: 480px)' href="<?php echo Yii::app()->request->baseUrl; ?>/css/mobile.css">
	<link rel="stylesheet" media='only screen and (min-device-width: 480px)' href="<?php echo Yii::app()->request->baseUrl; ?>/css/mobile.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/base.js"></script>
	<link rel="shortcut icon" href="/images/favicon.ico" />
</head>
<body>
<div id="page">
	<div id="header">
		<div id="logo"><a class="linkTitle" href="<?php echo Yii::app()->request->baseUrl;?>/"><?php echo CHtml::encode(Yii::app()->name); ?></a></div>
		<div id="mainmenu">
			<a href="#" id="menutoggle"><span>&laquo;</span>Menu</a>
			<ul>
				<li><a href="#">Find Nearest</a></li>
				<li><a href="#">Help</a></li>
			</ul>
		</div><!-- mainmenu -->
	</div><!-- header -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<div id="content_wrapper">
	<?php echo $content; ?>
	</div>

	<div id="footer">
		&copy; <?php echo date('Y'); ?> by <?php echo CHtml::encode(Yii::app()->params['siteName']); ?>.
		Powered by: <a href="<?php echo CHtml::encode(Yii::app()->params['poweredByUrl']); ?>"><?php echo CHtml::encode(Yii::app()->params['poweredBy']); ?></a>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
