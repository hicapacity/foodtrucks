<?php
$this->breadcrumbs=array(
	'Contact Uses'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ContactUs', 'url'=>array('index')),
	array('label'=>'Create ContactUs', 'url'=>array('create')),
	array('label'=>'View ContactUs', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ContactUs', 'url'=>array('admin')),
);
?>

<h1>Update ContactUs <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>