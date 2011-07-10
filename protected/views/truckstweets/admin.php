<?php
$this->breadcrumbs=array(
	'TrucksTweets'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('trucks-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage TrucksTweets</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trucks-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'truck_id',
		'tweet_id',
        'tweet',
        'menu_url',
        'start_time',
        'end_time',
        'geo_lat',
        'geo_long',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view}{delete}',
		),
	),
)); ?>
