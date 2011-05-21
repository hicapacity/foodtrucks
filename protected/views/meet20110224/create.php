<?php
$this->breadcrumbs=array(
	'Meet20110224s'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Meet20110224', 'url'=>array('index')),
	array('label'=>'Manage Meet20110224', 'url'=>array('admin')),
);
?>

<h1>Create Meet20110224</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>