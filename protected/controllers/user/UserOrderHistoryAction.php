<?php
class UserOrderHistoryAction extends CAction{
	

	public function run(){
		$uid = Yii::app()->user->id;
	 if($_SERVER['REQUEST_METHOD'] == 'POST') {
	  $d = Users::model()->get_user_orders($uid,$_POST['pair'],$_POST['type'],$_POST['stat']);
	  $temp = array();
	  if(sizeof($d)>0){
	   foreach($d as $k){
	    $temp[] = array("pair"=>strtoupper($k['pair']),"type"=>$k['type'],
					    "price"=>floatval($k['rate']),
						"amount"=>floatval($k['amount']),
						"percentage"=>(float)(($k['how_much']+$k['commission']) * 100)/$k['amount'],
						"total"=>(float)$k['total'],"timestamp"=>date("d.m.Y H:i",strtotime($k['timestamp'])));
	   }
	  }
	  echo json_encode(array("data"=>$temp));
	 }else{
	  echo 'what is this?';
	 }

	}
	
}