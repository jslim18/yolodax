<?php
error_reporting(0);
class TradingAction extends CAction{

	private static $controller;
	private static $model;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
		$this->updateTradingStatus();

	 $data = $this->tradingStatus();
	 self::$controller->render('trading',$data);
	}
	
	private function updateTradingStatus(){
		if(isset($_POST['request'])){
			if(isset($_POST['trading_status'])){
				$udp = array("is_trading"=>"yes");
				Yii::app()->db->createCommand()
						->update("ccurrency_pair",$udp);
			}else{
			$udp = array("is_trading"=>"no");
				Yii::app()->db->createCommand()
						->update("ccurrency_pair",$udp);
			}
		}		
	}
	
	private function tradingStatus(){
		 $res = Yii::app()->db->createCommand()
		 			->select("cpair_slug,is_trading")
					->from("ccurrency_pair")
					->queryAll();
		 $status = "no";
		 if(count($res) > 0){foreach($res as $k){
			 if($k['is_trading']=='yes'){$status="yes";}else{$status="no";}
		 }}
	  if($status == "yes"){$msg="Disable the trading on the website";}
	  else{$msg="Enable the trading on the website";}
	 $data['msg'] = $msg;
	 $data['status'] = $status;
	 return $data;
	}

}