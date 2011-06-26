<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" /> 
    <meta name="language" content="en" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->
    <link href="/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
</head>
<body>
<div class="container" id="page">

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/')),
				array('label'=>'Manage Trucks', 'url'=>array('/Trucks/admin'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Manage Twitter Accounts', 'url'=>array('/TwitterAccounts/admin'),'visible'=>!Yii::app()->user->isGuest),
                array(
                    'label' => 'Login',
                    'url' => array('/site/login'),
                    'visible' => Yii::app()->user->isGuest,
                ),
                array(
                    'label' => 'Logout (' . Yii::app()->user->name . ')',
                    'url' => array('/site/logout'),
                    'visible' => !Yii::app()->user->isGuest,
                ),                
                
			),
		)); ?>
	</div><!-- mainmenu -->


	<div id="header">
		<div id="logo"><a href="<?php echo Yii::app()->request->baseUrl . '/'; ?>">Streetgrindz Admin</a></div>
	</div><!-- header -->


	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by <?php echo CHtml::link('HI Capacity',Yii::app()->request->baseUrl . '/'); ?>.<br/>
		All Rights Reserved.<br/>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
