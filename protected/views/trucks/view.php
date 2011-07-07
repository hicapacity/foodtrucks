<?php
$this->breadcrumbs=array(
	'Trucks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Add New', 'url'=>array('create')),
	array('label'=>'Update This', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>View</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'twitter_id',
		'twitter_username',
		'icon_url',		
		'info',		
		'created',
		'modified',
	),
)); ?>
