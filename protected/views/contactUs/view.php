<?php
$this->breadcrumbs=array(
	'Contact Uses'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ContactUs', 'url'=>array('index')),
	array('label'=>'Create ContactUs', 'url'=>array('create')),
	array('label'=>'Update ContactUs', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ContactUs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ContactUs', 'url'=>array('admin')),
);
?>

<h1>View Contact Us #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'phone',
		'email_address',
		'message',
	),
)); ?>
