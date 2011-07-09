<?php
$this->breadcrumbs=array(
	'TrucksTweets'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>View</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'truck_id',
		'tweet_id',
		'tweet',
		'menu_url',		
        'start_time',
        'end_time',
		'geo_lat',		
		'geo_long',		
		'created',
		'modified',
	),
)); ?>
