<?php
class DepositingAction extends CAction{
	public function run(){
	 $txid = @explode("****",$_GET['txid']);
	  if(!empty($txid)){
	  $cur = $txid[1];
	  $txid = $txid[0];
	  
		$fun = $cur."Config";
		$to_do = Yii::app()->coinsconfig->$fun();
		$to_do['host'] = 'localhost';
		$obj = Yii::app()->coins;
		$obj->setCoin($to_do);
		$dd['txid'] = $txid;
		$dd['currency'] = $cur;
		$info = $obj->getTransaction($txid);
		if(! array_key_exists("errors", $info)){
			$dd['trans_info'] = serialize($info);
		}else{
			$dd['trans_info'] = serialize($info);
		}

		Yii::app()->db->createCommand()
			->insert("dlogs",array("data"=>serialize($dd)));
	  }
	}

}