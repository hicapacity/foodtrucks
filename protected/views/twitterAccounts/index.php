<?php
$this->breadcrumbs=array(
	'Twitter Accounts',
);

$this->menu=array(
	array('label'=>'Add New', 'url'=>array('create')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>Twitter Accounts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
