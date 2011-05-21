<?php
$this->breadcrumbs=array(
	'Meet 2011-02-24',
);

//$this->menu=array(
//	array('label'=>'Create Meet20110224', 'url'=>array('create')),
//	array('label'=>'Manage Meet20110224', 'url'=>array('admin')),
//);
?>

<h1>Meet 2011-02-24</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
