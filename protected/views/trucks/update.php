<?php
$this->breadcrumbs=array(
	'Trucks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Trucks', 'url'=>array('index')),
	array('label'=>'Create Trucks', 'url'=>array('create')),
	array('label'=>'View Trucks', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Trucks', 'url'=>array('admin')),
);
?>

<h1>Update Trucks <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>