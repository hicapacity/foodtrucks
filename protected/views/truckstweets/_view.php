<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('truck_id')); ?>:</b>
	<?php echo CHtml::encode($data->truck_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tweet_id')); ?>:</b>
	<?php echo CHtml::encode($data->tweet_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tweet')); ?>:</b>
	<?php echo CHtml::encode($data->tweet); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('menu_url')); ?>:</b>
	<?php echo CHtml::encode($data->menu_url); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('start_time')); ?>:</b>
	<?php echo CHtml::encode($data->start_time); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('end_time')); ?>:</b>
	<?php echo CHtml::encode($data->end_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('geo_lat')); ?>:</b>
    <?php echo CHtml::encode($data->geo_lat); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('geo_long')); ?>:</b>
    <?php echo CHtml::encode($data->geo_long); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

</div>
