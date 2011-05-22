<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'trucks-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
		"model"=>$model,                # Data-Model
		"attribute"=>'menu',         # Attribute in the Data-Model
		"height"=>'400px',
		"width"=>'100%',
		"toolbarSet"=>'Default',          # EXISTING(!) Toolbar (see: fckeditor.js)
		"fckeditor"=>Yii::app()->basePath."/../web/fckeditor/fckeditor.php",
										# Path to fckeditor.php
		"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",
										# Realtive Path to the Editor (from Web-Root)
		"config" => array(
			"EditorAreaCSS"=>Yii::app()->baseUrl.'/css/index.css',),
										# http://docs.fckeditor.net/FCKeditor_2.x/Developers_Guide/Configuration/Configuration_Options
										# Additional Parameter (Can't configure a Toolbar dynamicly)
    ) ); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo'); ?>
		<?php echo $form->textField($model,'photo',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'photo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>    

<?php $this->endWidget(); ?>

</div><!-- form -->