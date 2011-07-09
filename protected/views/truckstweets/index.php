<?php
$this->breadcrumbs=array(
	'TrucksTweets',
);

$this->menu=array(
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>Trucks Tweets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
