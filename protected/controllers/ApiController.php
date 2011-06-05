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

	public function actionRaiseException(){
		/* Client testing api. This api call always returns an error */
		$this->layout = false;
		header('Content-type: application/json');
		echo json_encode(Array('status'=>'fail', 'data'=>'Your request failed because you wanted it to.'));
		Yii::app()->end();
	}

	/**
	 * Finds all trucks that have tweeted to us and their geo coords
	 */
	public function actionTrucks()
	{
		$this->layout = false;
		header('Content-type: application/json');
		$trucksObj = Trucks::model()->with('trucksTweets:coords')->findAll();
		$trucks = array();
		foreach ($trucksObj as $truck) {
		    if (is_array($truck->trucksTweets) && count($truck->trucksTweets)>0) {
				$tweet = $truck->trucksTweets[0];
				$trucks[] = Array(
					"id"=>$truck->id,
					"lat"=>$tweet->geo_lat,
					"lng"=>$tweet->geo_long,
					"name"=>$truck->twitter_username,
					"info"=>"test",
				);
			}
		}
		if (count($trucks)==0) {
			$trucks[] = "No Trucks Found!";
			echo json_encode(Array('status'=>'fail', 'data'=>$trucks));
			Yii::app()->end();
		}
		echo json_encode(Array('status'=>'success', 'data'=>$trucks));
		Yii::app()->end();
	}

	/**
	 * Find a single truck based on their primary key!
	 */
	public function actionTruck($id){
		$id = (int)$id;
		$this->layout = false;
		header('Content-type: application/json');
		$truck = Trucks::model()->with('trucksTweets:coords')->find(array(
			'condition'=>'t.id=:id',
			'params'=>array(':id'=>$id),
		));
																	;
		$trucks = array();
		if (NULL !== $truck) {
		    if (is_array($truck->trucksTweets) && count($truck->trucksTweets)>0) {
				$tweet = $truck->trucksTweets[0];	
				$trucks[] = Array(
					"id"=>$truck->id,
					"lat"=>$tweet->geo_lat,
					"lng"=>$tweet->geo_long,
					"name"=>$truck->twitter_username,
					"info"=>"test",
				);
			} else {
				$trucks[] = "This truck has no tweets!";
				echo json_encode(Array('status'=>'fail', 'data'=>$trucks));
				Yii::app()->end();
			}
		} else {
			$trucks[] = "This truck does not exist..";
			echo json_encode(Array('status'=>'fail', 'data'=>$trucks));
			Yii::app()->end();
		}
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
