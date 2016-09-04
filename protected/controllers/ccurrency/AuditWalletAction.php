<?php
class AuditWalletAction extends CAction{
	private $controller;

	public function run(){
	 $this->controller = $this->getController();
		if($_SERVER['REQUEST_METHOD']=="POST" and Yii::app()->request->isAjaxRequest){
		ini_set('max_execution_time', 300);
			if($_POST['c']=='dogecoin'){
			 $this->doDoge($_POST['q']);
			}elseif($_POST['c']=='litecoin'){
			 $this->doLtc($_POST['q']);
			}elseif($_POST['c']=='bitcoin'){
			 $this->doBtc($_POST['q']);
			}else{
				die;
			}
		}else{
		 echo 'No direct script access!';
		}
	}


	private function doDoge($add){
	 $s1 = file_get_contents("https://dogechain.info/chain/Dogecoin/q/addressbalance/".$add);
	 //$s2 = file_get_contents("http://bkchain.org/doge/api/v1/address/balance/".$add);
	 //$s2 = json_decode($s2);
	 //$s2 = (float)($s2[0]->balance/100000000);
		 if($s1 != ""){
		  $val = min(array($s1));
		  echo json_encode(array("val"=>$val));die;
		 }
	}

	private function doLtc($add){
	 $s1 = file_get_contents("http://ltc.blockr.io/api/v1/address/balance/".$add);
	 $s1 = json_decode($s1);
	 $s1 = $s1->data->balance;
		 if($s1 != ""){
		  $val = $s1;
		  echo json_encode(array("val"=>$val));die;
		 }
	}

	private function doBtc($add){
	 $s1 = file_get_contents("http://blockchain.info/q/addressbalance/".$add);
	 //$s2 = file_get_contents("http://btc.blockr.io/api/v1/address/balance/".$add);
	 //$s3 = file_get_contents("https://btcplex.com/api/addressbalance/".$add);
	 $s1 = (float)($s1/100000000);
	 //$s2 = json_decode($s2);
	 //$s2 = $s2->data->balance;
	 //$s3 = (float)($s3/100000000);
		 if($s1 != ""){
		  $val = min(array($s1));
		  echo json_encode(array("val"=>$val));die;
		 }
	}

}