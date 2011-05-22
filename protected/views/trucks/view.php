<?php
$this->breadcrumbs=array(
	'Trucks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Trucks', 'url'=>array('index')),
	array('label'=>'Create Trucks', 'url'=>array('create')),
	array('label'=>'Update Trucks', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Trucks', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Trucks', 'url'=>array('admin')),
);
?>

<h1>View Trucks #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'twitter_id',
		'twitter_username',
		'menu',
		'photo',
		'created',
		'modified',
	),
)); ?>
