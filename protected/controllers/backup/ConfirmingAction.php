<?php
class ConfirmingAction extends CAction{

	public function run(){
	ini_set('max_execution_time', 300);
		$res = Yii::app()->db->createCommand()
						->select("id,currency,user_id,label,address")
						->from("addresses")
						->where("is_used='no' and id > (select last_r_id from fruptorid limit 0,1)")
						->limit(1,0)
						->queryAll();
		if(sizeof($res) > 0){
			$last = end($res);$last_id=$last['id'];
			Yii::app()->db->createCommand()->update("fruptorid",array('last_r_id'=>$last_id));
			if($res[0]['currency']=='dogecoin'){
			 $this->doDoge($res[0]);
			}elseif($res[0]['currency']=='litecoin'){
			 $this->doLtc($res[0]);
			}elseif($res[0]['currency']=='bitcoin'){
			 $this->doBtc($res[0]);
			}else{
				die;
			}
		}else{
			Yii::app()->db->createCommand()->update("fruptorid",array('last_r_id'=>'0'));
		}
	}

	private function doDoge($add){
	 $s1 = file_get_contents("https://dogechain.info/chain/Dogecoin/q/addressbalance/".$add['address']);
	 $s2 = file_get_contents("http://bkchain.org/doge/api/v1/address/balance/".$add['address']);
	 $s2 = json_decode($s2);
	 $s2 = (float)($s2[0]->balance/100000000);
		 if($s1 != "" && $s2 != ""){
		  $val = min($s1,$s2);
		  $this->updateAddress($val,$add);
		 }
	}

	private function doLtc($add){
	 $s1 = file_get_contents("http://ltc.blockr.io/api/v1/address/balance/".$add['address']);
	 $s1 = json_decode($s1);
	 $s1 = $s1->data->balance;
		 if($s1 != ""){
		  $val = $s1;
		  $this->updateAddress($val,$add);
		 }
	}

	private function doBtc($add){
	 $s1 = file_get_contents("http://blockchain.info/q/addressbalance/".$add['address']);
	 $s2 = file_get_contents("http://btc.blockr.io/api/v1/address/balance/".$add['address']);
	 $s3 = file_get_contents("https://btcplex.com/api/addressbalance/".$add['address']);
	 $s1 = (float)($s1/100000000);
	 $s2 = json_decode($s2);
	 $s2 = $s2->data->balance;
	 $s3 = (float)($s3/100000000);
		 if($s1 != "" && $s2 != "" && $s3 != ""){
		  $val = min($s1,$s2,$s3);
		  $this->updateAddress($val,$add);
		 }
	}

	private function updateAddress($val,$add){
		  $upd['amount'] = $val;
		  $upd['is_used'] = 'yes';
		  $upd['updated_at'] = date('Y-m-d H:i:s');
		  $condS = 'id=:id and user_id=:u and address=:ad and currency=:cur';
		  $cond[":id"] = $add['id'];
		  $cond[":u"] = $add['user_id'];
		  $cond[":ad"] = $add['address'];
		  $cond[":cur"] = $add['currency'];
	  	 $cur = $add['currency'];
		 $uid = $add['user_id'];
		$trans = Yii::app()->db->beginTransaction();
		try{
		 Yii::app()->db->createCommand()->update("addresses",$upd,$condS,$cond);
		 $cmd = Yii::app()->db->createCommand("update amounts set `$cur`=`$cur`+$val where user_id='$uid'");
		 $cmd->execute();
		 $trans->commit();
		}catch(Exception $ex){$trans->rollback();}
	}
// update amounts set litecoin=0,bitcoin=0,dogecoin=0;update addresses set is_used='no', amount=0;
}