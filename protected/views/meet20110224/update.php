<?php
$this->breadcrumbs=array(
	'Meet20110224s'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Meet20110224', 'url'=>array('index')),
	array('label'=>'Create Meet20110224', 'url'=>array('create')),
	array('label'=>'View Meet20110224', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Meet20110224', 'url'=>array('admin')),
);
?>

<h1>Update Meet20110224 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>