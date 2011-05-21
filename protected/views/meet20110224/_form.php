<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'meet20110224-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($modelCreate); ?>

	<div class="row">
		<?php echo $form->labelEx($modelCreate,'name'); ?>
		<?php echo $form->textField($modelCreate,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($modelCreate,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelCreate,'email'); ?>
		<?php echo $form->textField($modelCreate,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($modelCreate,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($modelCreate->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->