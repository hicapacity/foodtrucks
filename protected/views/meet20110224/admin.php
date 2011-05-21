<?php
$this->breadcrumbs=array(
	'Meet 2011-02-24',
);

//$this->menu=array(
//	array('label'=>'List Meet20110224', 'url'=>array('index')),
//	array('label'=>'Create Meet20110224', 'url'=>array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('meet20110224-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Meet and Greet - February 24, 2011</h1>
<h3>Murphy's Bar and Grill, Honolulu, HI</h3>
<?php if (strlen($msg)>0) { ?>
<p>
	<?php echo $msg; ?>
</p>
<?php } ?>

<p>Enter your info to attend (Your email will not be shown and will only be used for internal correspondence):</p>
<?php echo $this->renderPartial('_form', array('modelCreate'=>$modelCreate)); ?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'meet20110224-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		'name',
		'date_created',
		//array(
		//	'class'=>'CButtonColumn',
		//),
	),
)); ?>
