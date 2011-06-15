<?php
$this->pageTitle=Yii::app()->name . ' - About';
?>
<div data-role="page" data-theme="b">
<div data-role="header">
	<h1>About FoodTrucksApp</h1>
</div>
<div data-role="content">
	<div id='appTitle'>
	   <h2>FoodTrucks App</h2>

	<div id='faq'>
	   <div class='question'>
		<h3>What's this for?</h3>
	   </div>
	   <div class='answer'>
		<p>Well, hopefully if you are here you already have a slight understanding.  If not let me elaborate.  FoodTrucks is a simple innovative application that allows hungry people to find their favorite food fast.  In our city there are dozens of delicious food trucks all over and the move all over the island frequently.  With the FoodTrucks App you can share your current location and it will show you all the Food Trucks nearest to you.</p>
	   </div>
	   <div class='question'>
		<h3>How do I get my truck listed here?</h3>
	   </div>
	   <div class='answer'>
		<p>This is the simple part, sign up as a Food Truck and after you are validated all you have to do is do a mention to <?php echo Yii::app()->params['trucks']['twitter']['userName']; ?> on Twitter.   That’s it, once you do that mention to twitter from your GPS enabled smart phone the FoodTrucks App will grab your location from the tweet and show it in real time on the Map for hungry people all over to find. <br/>

To get Signed up as a Food Truck go <?php echo CHtml::link('here', array('site/page','view'=>'Signup'),array('id'=>'signupLink')); ?>.
</p>
	   </div>
	   <div class='question'>
		<h3>What is a Twitter mention?  </h3>
	   </div>
	   <div class='answer'>
		<p>A twitter mention is simply mentioning that user with an ‘@’ in front of the name for example to you could send a mention to <?php echo Yii::app()->params['trucks']['twitter']['userName']; ?> by tweeting the following.<br/>

		‘Hey @<?php echo Yii::app()->params['trucks']['twitter']['userName']; ?> Fresh and Hot Malasadas $6/dozen today only!’<br/>

		That’s it, our FoodTrucks App will read this from the Twitter sphere and update your location on our Map.
		</p>
	   </div>
	</div>
	
</div>
</div>
