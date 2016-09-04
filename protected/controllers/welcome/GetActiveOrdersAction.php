<?php
class GetActiveOrdersAction extends CAction{


	public function run(){
		if(count($_POST) > 0){
		 $orders = Users::model()->get_user_active_orders(Yii::app()->user->id,$_POST['pair']);
		 $temp = array();
		 if(sizeof($orders)>0){
		  foreach($orders as $k){
		   $temp[] = array("id"=>$k['id'],
						   "type"=>$k['type'],
		   				   "amount"=>floatval($k['amountt'])." ".$k['currency_short'],
						   "rate"=>floatval($k['rate']),
						   "total"=>floatval($k['rate'] * $k['amountt']),
						   "timestamp"=>date("d.m.Y H:i",strtotime($k['timestamp'])));
		  }
		 }
		 echo json_encode(array("data"=>$temp));
		}else{
		 echo "what is this?";
		}
	}


}