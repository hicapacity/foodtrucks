<?php $this->beginContent('//layouts/main'); ?>
	<div data-fullscreen="true" data-role="page" data-theme="b" class="content_wrapper">
		<div data-role="header" data-position="fixed">
			<h1><img src="images/StreetgrindzLogo.png"> <?php echo CHtml::encode(Yii::app()->name); ?></h1>
		</div>
		<div data-role="content" class="content">
			<div id="content_map">
				<?php echo $content; ?>
			</div><!-- content -->
		</div>
		<div data-role="footer" data-position="fixed" class="footer">
			<p style="text-align:center; font-size:.75em;">
			&copy; <?php echo date('Y'); ?> by <?php echo CHtml::encode(Yii::app()->params['siteName']); ?>
            <br/>
			Powered by: <a href="<?php echo CHtml::encode(Yii::app()->params['poweredByUrl']); ?>"><?php echo CHtml::encode(Yii::app()->params['poweredBy']); ?></a>
			</p>
		</div>
	</div>
<?php $this->endContent(); ?>
