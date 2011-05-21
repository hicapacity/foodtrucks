<?php
$this->breadcrumbs=array(
	'Meet20110224s'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Meet20110224', 'url'=>array('index')),
	array('label'=>'Create Meet20110224', 'url'=>array('create')),
	array('label'=>'Update Meet20110224', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Meet20110224', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Meet20110224', 'url'=>array('admin')),
);
?>

<h1>View Meet20110224 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'email',
		'date_created',
	),
)); ?>
