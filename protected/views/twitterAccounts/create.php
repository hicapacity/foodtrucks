<?php
$this->breadcrumbs=array(
	'Twitter Accounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>Add Allowed Twitter Account</h1>

<p>The added account will be permitted to send tweets from their truck location.<br />
You must add either a Twitter Name, or their account ID.</p>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
