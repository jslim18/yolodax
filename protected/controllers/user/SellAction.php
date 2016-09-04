<?php
class SellAction extends CAction{
	

	public function run(){
		if(count($_POST) > 0){
		 $_POST['user_id'] = Yii::app()->user->id;
		 $cinfo = Users::model()->currency_type($_POST['pair']);
		 $amounts=json_decode(json_encode(Users::model()->get_user_calc(Yii::app()->user->id,$cinfo['coin'])),1);
		 if($cinfo['is_trading']=="yes"){
			 if($amounts[$cinfo['coin']]>=floatval($_POST['sell'])){
				Users::model()->do_sell_for_user();
				echo json_encode(array("status"=>true));
			 }else{
			  Yii::app()->user->setFlash("error","You have to login first!");
				echo json_encode(array("status"=>false,
										"message"=>"You don't have sufficient amount!"));
			 }
		 }else{
		 Yii::app()->user->setFlash("error","You have to login first!");
			  echo json_encode(array("status" => false,
									 "message" => "Trading is off, temporarily!"));
		 }
		 
		}else{
		Yii::app()->user->setFlash("error","You have to login first!");
		echo 'what is this?';
		}
	}
	
	
}