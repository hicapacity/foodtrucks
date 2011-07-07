<?php
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
	 * Finds all open trucks that have tweeted to us and their geo coords
	 */
	public function actionTrucks()
	{
		$trucks = Trucks::get_all_open_and_located_trucks();
		if (count($trucks)) {
			$this->sendJsonResponse(Array(
				'status'=>'success',
				'data'=>$trucks));
		}else{
			$this->sendJsonResponse(Array(
				'status'=>'fail',
				'data'=>'No Trucks Found!'));
		}
	}

	/**
	 * Find a single truck based on their primary key!
	 */
	public function actionTruck($id){
		$truck = Trucks::get_truck_by_id($id);
		if (count($truck)){
			$this->sendJsonResponse(Array(
				'status'=>'success',
				'data'=>$truck[0]));
		}else{
			$this->sendJsonResponse(Array(
				'status'=>'fail',
				'data'=>'This truck does not exist..'));
		}
	}

	public function actionInfo(){
        $info = Array(
            'streetgrindz_url' => 'http://streetgrindz.com',
            'streetgrindz_bio' => 'StreetGrindz Rules',
            'hicapacity_url' => 'http://hicapacity.org'
        );
        $this->sendJsonResponse(Array(
            'status'=>'success',
            'data'=>$info));
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
