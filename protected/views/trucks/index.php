<?php
$this->breadcrumbs=array(
	'Trucks',
);

$this->menu=array(
	array('label'=>'Create Trucks', 'url'=>array('create')),
	array('label'=>'Manage Trucks', 'url'=>array('admin')),
);
?>

<h1>Trucks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
