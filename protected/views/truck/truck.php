<?php
$this->pageTitle=Yii::app()->name . ' - Truck Info';
?>
<div data-role="page" data-theme="b">
<div data-role="header">
	<h1><?php echo $truck['name']; ?></h1>
</div>
<div data-role="content">
	<h2><?php echo $truck['name']; ?></h2>
	<h4>Twitter ID: <?php echo $truck['id'] ?></h4>
	<p>
		<?php echo $truck['info']; ?>
	</p>
</div>
</div>
