<?php
class TruckController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
	}

	public function actionId(){
		if (($id = key($_GET)) !== NULL){
			$id = (int)$id;
			$truck = Trucks::get_truck_by_id($id);
			if (count($truck)){
				$this->render('truck', array(
					'truck'=>$truck[0],
				));
				return;
			}
		}
		throw new CHttpException(404, 'Oops. Not found.'); 
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
