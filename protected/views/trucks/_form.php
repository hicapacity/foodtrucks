<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'trucks-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'twitter_id'); ?>
		<?php echo $form->textField($model,'twitter_id',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'twitter_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'twitter_username'); ?>
		<?php echo $form->textField($model,'twitter_username',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'twitter_username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu'); ?>
		<?php echo $form->textField($model,'menu',array('size'=>60,'maxlength'=>32768)); ?>
		<?php echo $form->error($model,'menu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo'); ?>
		<?php echo $form->textField($model,'photo',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
		<?php echo $form->error($model,'modified'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->