<?php
/*
NOTE:
Routes are done in config.php.  If you need to add more api functions, you need to map them there.
*/
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

	public function actionRaise_Exception(){
		/* Client testing api. This api call always returns an error */
		$this->layout = false;
		header('Content-type: application/json');
		echo json_encode(Array('status'=>'fail', 'data'=>'Your request failed because you wanted it to.'));
		Yii::app()->end();
	}

	public function actionAll_Trucks()
	{
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
		echo json_encode(Array('status'=>'success', 'data'=>$trucks));
		Yii::app()->end();
	}
	public function actionTruck_By_Id($id){
		$id = (int)$id;
		$this->layout = false;
		header('Content-type: application/json');
		$trucks = Array();
		$lat = 21.466;
		$lng = -157.9833;
		$delta = 100;
		$ntruck = Array(
			"id"=>$id,
			"lat"=>rand(-$delta, $delta)/1000+$lat,
			"lng"=>rand(-$delta, $delta)/1000+$lng,
			"name"=>"FoodTruck{$id}",
			"info"=>"<h2>Blah Blah{$id}</h2><p>More blah blah blah</p>",
		);
		$trucks[] = $ntruck;
		echo json_encode(Array('status'=>'success', 'data'=>$trucks));
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
