<?php
class LoadMoreAction extends CAction{

	private static $controller;

	public function run(){
	 self::$controller = $this->getController();
	 if($_SERVER['REQUEST_METHOD']=="POST" and Yii::app()->request->isAjaxRequest){
	  $st = explode(",",$_POST['type']);
	  $ct = $_POST['ct'];
		$data['widreqs'] = Yii::app()->db->createCommand()
								->select("withdrawals.*, users.username")
								->from("withdrawals")
								->join("users","users.id=withdrawals.user_id")
								->where(array("in","withdrawals.status",$st))
								->andWhere("wid>:wid",array(":wid"=>$_POST['rc']))
								->limit(20,0)
								->queryAll();
		$data['action'] = Yii::app()->getBaseUrl(true)."/$ct";
		$rr = self::$controller->renderPartial('load_more_requests', $data,true);
		if(!empty($data['widreqs'])){
		 echo json_encode(array("status"=>"ok","msg"=>$rr));
		}else{
		 echo json_encode(array("status"=>"error","msg"=>null));
		}
	  die;
	 }else{
	  echo 'No Direct Script Access!';
	 }

	}


}