<?php
/*
NOTE:
Routes are done in config.php.  If you need to add more api functions, you need to map them there.
*/
class ApiController extends Controller
{

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->sendJsonResponse(Array(
			"Streetgrindz API"=>"Yes"));
	}

	public function actionRaiseException(){
		/* Client testing api. This api call always returns an error */
		$this->sendJsonResponse(Array(
			'status'=>'fail',
			'data'=>'Your request failed because you wanted it to.'));
	}

	/**
	 * Finds all trucks that have tweeted to us and their geo coords
	 */
	public function actionTrucks()
	{
		$trucksObj = Trucks::model()->with('trucksTweets:coords')->findAll();
		$trucks = array();
		foreach ($trucksObj as $truck) {
			$this->_truck($trucks,$truck,false);
		}
		if (count($trucks)==0) {
			$this->sendJsonResponse(Array(
				'status'=>'fail',
				'data'=>'No Trucks Found!'));
		} else {
			$this->sendJsonResponse(Array(
				'status'=>'success',
				'data'=>$trucks));
		}
	}

	/**
	 * Find a single truck based on their primary key!
	 */
	public function actionTruck($id){
		$id = (int)$id;
		$truck = Trucks::model()->with('trucksTweets:coords')->find(array(
			'condition'=>'t.id=:id',
			'params'=>array(':id'=>$id),
		));
		$trucks = array();
		if (NULL !== $truck) {
			$this->_truck($trucks,$truck);
			$this->sendJsonResponse(Array(
				'status'=>'success',
				'data'=>$trucks));
		} else {
			$this->sendJsonResponse(Array(
				'status'=>'fail',
				'data'=>'This truck does not exist..'));
		}
	}
	
	function _truck(&$trucks,$truck,$noTweets=true) {
		if (is_array($truck->trucksTweets) && count($truck->trucksTweets)>0) {
			$tweet = $truck->trucksTweets[0];	
			$trucks[] = Array(
				"id"=>$truck->id,
				"lat"=>$tweet->geo_lat,
				"lng"=>$tweet->geo_long,
				"name"=>$truck->twitter_username,
				"info"=>"test",
			);
		} else if ($noTweets) {
			$this->sendJsonResponse(Array(
				'status'=>'fail',
				'data'=>'This truck has no tweets!'));
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
	    if($error=Yii::app()->errorHandler->error) {
	    	if(Yii::app()->request->isAjaxRequest) {
	    		echo $error['message'];
	    	} else {
	        	$this->render('error', $error);
	    	}
	    }
	}
}
