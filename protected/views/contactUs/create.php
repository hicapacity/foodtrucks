<?php
$this->breadcrumbs=array(
	'Contact Us'=>array('index'),
	'Create',
);

//$this->menu=array(
//	array('label'=>'List ContactUs', 'url'=>array('index')),
//	array('label'=>'Manage ContactUs', 'url'=>array('admin')),
//);
?>

<h1>Contact HackerSpace</h1>

<?php echo $this->renderPartial('/contactUs/_form', array('model'=>$model)); ?>