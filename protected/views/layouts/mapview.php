<?php $this->beginContent('//layouts/main'); ?>
	<div data-fullscreen="true" data-role="page" data-theme="b" class="content_wrapper">
		<div data-role="header" data-position="fixed">
			<h1><img src="images/StreetgrindzLogo.png"> <?php echo CHtml::encode(Yii::app()->name); ?></h1>
			<a data-icon="gear" data-rel="dialog" class="ui-btn-right" href="#menu">Menu</a>
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

	<div id="menu" data-role="page" data-theme="b">
		<div data-role="header">
			<h1>Menu</h1>
		</div>
		<div data-role="content">
		<ul data-role="listview" data-inset="true">
			<li><a href="#" id="foodtrucks_load_nearest">Find Nearest</a></li>
			<li><a href="#" id="foodtrucks_load_nearest">Find Nearest</a></li>
			<li><?php echo CHtml::link('Info', array('site/page','view'=>'about'),array('id'=>'foodtrucks_load_nearest')); ?>
		</ul>
		</div>
	</div>
<?php $this->endContent(); ?>
