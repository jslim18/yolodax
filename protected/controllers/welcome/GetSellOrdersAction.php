<?php
class GetSellOrdersAction extends CAction{


	public function run(){

	if(Yii::app()->user->id!=""){
	 $uid = Yii::app()->user->id;
	}else{
	 $uid = 0;
	}
	$temp = array();
		if(count($_POST) > 0){
		 $orders = Users::model()->get_sell_orders($_POST['coin'],$_POST['hard'],$uid);
		 if(sizeof($orders)>0){
		  foreach($orders as $k){
		   $temp[] = array("rate"=>floatval($k['rate']),
		   				   "amount"=>floatval($k['amount']),
						   "total"=>floatval($k['amount']*$k['rate']));
		  }
		 }
		 echo json_encode(array("data"=>$temp));
		}else{
		 echo "what is this?";
		}


	}


}