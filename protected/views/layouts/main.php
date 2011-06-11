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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<!-- Using same css for now since we're targeting devices -->	
	<link rel="stylesheet" media='only screen and (max-device-width: 480px)' href="<?php echo Yii::app()->request->baseUrl; ?>/css/mobile.css">
	<link rel="stylesheet" media='only screen and (min-device-width: 480px)' href="<?php echo Yii::app()->request->baseUrl; ?>/css/mobile.css">

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.css" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.js"></script>

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<link rel="shortcut icon" href="/images/favicon.ico" />

  <!-- FOODTRUCK SPECIFIC STUFF -->
	<link rel="stylesheet/less" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/less/main.less" />
	<script type="text/javascript" src="http://lesscss.googlecode.com/files/less-1.1.3.min.js"></script>

	<script type="text/coffeescript" src="<?php echo Yii::app()->request->baseUrl; ?>/coffee/api.coffee"></script>
	<script type="text/coffeescript" src="<?php echo Yii::app()->request->baseUrl; ?>/coffee/menu.coffee"></script>
	<script type="text/coffeescript" src="<?php echo Yii::app()->request->baseUrl; ?>/coffee/truck.coffee"></script>
	<script type="text/coffeescript" src="<?php echo Yii::app()->request->baseUrl; ?>/coffee/foodtruck.coffee"></script>
	<script type="text/javascript" src="http://jashkenas.github.com/coffee-script/extras/coffee-script.js"></script>
	

</head>
<body>
<div id="page">
	<div data-fullscreen="true" data-role="page" class="content_wrapper">
		<div data-role="header" data-position="fixed" class="header">
			<div class="logo"><a class="linkTitle" href="<?php echo Yii::app()->request->baseUrl;?>/"><?php echo CHtml::encode(Yii::app()->name); ?></a></div>
			<div class="mainmenu">
				<a href="#" class="menutoggle"><span>&laquo;</span>Menu</a>
				<ul>
					<li><a href="#find_all">Show All</a></li>
					<li><a href="#find_nearest">Find Nearest</a></li>
					<li><a href="#help">Help</a></li>
				</ul>
			</div><!-- mainmenu -->
		</div><!-- header -->
		<div data-role="content" class="content">
			<?php echo $content; ?>
		</div>
		<div data-role="footer" data-position="fixed" class="footer">
			&copy; <?php echo date('Y'); ?> by <?php echo CHtml::encode(Yii::app()->params['siteName']); ?>.
			Powered by: <a href="<?php echo CHtml::encode(Yii::app()->params['poweredByUrl']); ?>"><?php echo CHtml::encode(Yii::app()->params['poweredBy']); ?></a>
		</div><!-- footer -->
	</div>
</div><!-- page -->

</body>
</html>
