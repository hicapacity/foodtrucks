<?php
$this->breadcrumbs=array(
	'Contact Uses',
);

$this->menu=array(
	array('label'=>'Create ContactUs', 'url'=>array('create')),
	array('label'=>'Manage ContactUs', 'url'=>array('admin')),
);
?>

<h1>Contact Us</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
