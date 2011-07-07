<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'twitter-accounts-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'twitter_id'); ?>
		<?php echo $form->textField($model,'twitter_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'twitter_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'twitter_username'); ?>
		<?php echo $form->textField($model,'twitter_username',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'twitter_username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'icon_url'); ?>
		<?php echo $form->textField($model,'icon_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'icon_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info'); ?>
		<?php echo $form->textArea($model,'info',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'info'); ?>
	</div>

	<?php if ($model->isNewRecord) { ?>
		<div class="row">
			<?php echo CHtml::encode($model->created); ?>
		</div>
	
		<div class="row">
			<?php echo CHtml::encode($model->modified); ?>
		</div>
	<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
