<?php
$this->breadcrumbs=array(
	'Trucks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Trucks', 'url'=>array('index')),
	array('label'=>'Manage Trucks', 'url'=>array('admin')),
);
?>

<h1>Create Trucks</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>