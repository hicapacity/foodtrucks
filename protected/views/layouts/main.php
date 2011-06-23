<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.css" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.js"></script>

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<link rel="shortcut icon" href="images/favicon.ico" />

  <!-- FOODTRUCK SPECIFIC STUFF -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

	<script type="text/coffeescript" src="<?php echo Yii::app()->request->baseUrl; ?>/coffee/api.coffee"></script>
	<script type="text/coffeescript" src="<?php echo Yii::app()->request->baseUrl; ?>/coffee/menu.coffee"></script>
	<script type="text/coffeescript" src="<?php echo Yii::app()->request->baseUrl; ?>/coffee/truck.coffee"></script>
	<script type="text/coffeescript" src="<?php echo Yii::app()->request->baseUrl; ?>/coffee/foodtruck.coffee"></script>
	<script type="text/javascript" src="http://jashkenas.github.com/coffee-script/extras/coffee-script.js"></script>
	

</head>
<body>
	<?php echo $content; ?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo Yii::app()->params['analytics']; ?>']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
