<?php

class ApiController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->layout = false;
		header('Content-type: application/json');
		echo json_encode(Array("blah"=>"blah2"));
		Yii::app()->end();
	}

	public function actionAllFoodTrucks()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->layout = false;
		header('Content-type: application/json');
		$trucks = Array();
		$lat = 21.466;
		$lng = -157.9833;
		$delta = 100;
		for($i=0;$i<10;$i++){
			$ntruck = Array(
				"id"=>$i,
				"lat"=>rand(-$delta, $delta)/1000+$lat,
				"lng"=>rand(-$delta, $delta)/1000+$lng,
				"name"=>"FoodTruck{$i}",
				"info"=>"<h2>Blah Blah{$i}</h2><p>More blah blah blah</p>",
			);
			$trucks[] = $ntruck;
		}
		echo json_encode($trucks);
		Yii::app()->end();
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
}
