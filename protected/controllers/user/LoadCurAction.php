<?php
class LoadCurAction extends CAction{

	private $uid;
	private $controller;
	private $errorMsg;

	public function run(){
	$this->controller = $this->getController();
	$this->uid = Yii::app()->user->getId();
	$ccur = $_POST['cur'];
	  if($_POST['type'] == "load_deposit"){
			$res = Yii::app()->db->createCommand()
						->select("currency_short")
						->from("ccurrencies")
						->where("currency=:ccur",array(":ccur"=>$ccur))
						->limit(1,0)
						->queryRow();
			if(@$res['currency_short']!=""){
				$data['address'] = $this->do_currency($ccur);
				$data['currency_short'] = $res['currency_short'];
				$this->controller->renderPartial("/user/load_deposit",$data);			
			}else{
			 echo 'What is this?';
			}
			
	  }elseif($_POST['type']=="load_withdraw"){
	    if(! $this->checkVerifications()){
			echo $this->errorMsg;
		}else{
			$res = Yii::app()->db->createCommand()
						->select("currency_short")
						->from("ccurrencies")
						->where("currency=:ccur",array(":ccur"=>$ccur))
						->limit(1,0)
						->queryRow();
			$data['currency_short'] = $res['currency_short'];
			$min_limit = 1;
			$max_limit = 100;
			$fee = 0.5;
			$am = Users::model()->get_user_calc($this->uid);
			$with = Users::model()->withdraw_data($this->uid);
			$data['fee'] = $fee;
			$data['currency'] = $ccur;
			$data['currency_short'] = $res['currency_short'];
			$data['user_id'] = $this->uid;
			$data['min_limit'] = $min_limit;
			$data['max_limit'] = $max_limit;
			$data['btc'] = $am->$ccur - @$with[$ccur];
			$this->controller->renderPartial("/user/load_w",$data);
		}
	  }else{
		  echo 'Nothing is there to be loaded!';
	  }
	}

	private function checkVerifications(){
		$id = Yii::app()->user->getId();
		$info = Yii::app()->db->createCommand()
					->select("status, billing_address_status, IC_status, is_g2a")
					->from("users")
					->where("id=:id",array(":id"=>$id))
					->limit(1,0)
					->queryRow();
		if($info['status']==0){
			$this->errorMsg = 'Your email is not verified yet!';
		return false;
		}elseif($info['billing_address_status']=='no'){
			$this->errorMsg = 'Your billing address is not verified yet!';
		return false;
		}elseif($info['IC_status']=='no'){
			$this->errorMsg = 'Your Identification numbers is not verified yet!';
		return false;
		}elseif($info['is_g2a']=='no'){
			$this->errorMsg = 'You have not enabled google 2 factor authentication yet!';
		return false;
		}else{
		 return true;
		}
	}

	private function user_cread($to_do = array()){
	  return array("coin"=>$to_do['coin'],
 	      		   "user"=>$to_do['user'],
 	      		   "password"=>$to_do['password'],
		  		   "host"=>$_SERVER['HTTP_HOST'],
		  		   "port"=>$to_do['port']);
	}

	private function do_currency($currency){
			$address = NULL;
			$uid = $this->uid;
			$res = Yii::app()->db->createCommand()
					->select("*")
					->from("addresses")
					->where("currency=:coin",array(":coin"=>$currency))
					->andWhere("user_id=:uid",array(":uid"=>$uid))
					->andWhere("is_used=:iu",array(":iu"=>"no"))
					->limit(1,0)
					->queryAll();
			if(count($res)==0){
			$addr = Yii::app()->db->createCommand()
								->select("*")
								->from("imports")
								->where("currency=:coin",array(":coin"=>$currency))
								->limit(1,0)
								->order("id")
								->queryAll();
				if(count($addr)>0){
				 $model = new Addresses;
				 $asa = new AssignAddresses;
				 $date = date("Y-m-d H:i:s");
				 $ist = array("user_id"=>$this->uid,"currency"=>$addr[0]['currency'],
							  "label"=>$addr[0]['label'],"address"=>$addr[0]['address'],
							  "created_at"=>$date,"updated_at"=>$date);
				 $aist = array("user_id"=>$this->uid,"currency"=>$addr[0]['currency'],
							   "label"=>$addr[0]['label'],"address"=>$addr[0]['address'],
							   "file_from"=>$addr[0]['uploaded_file'],"timestamp"=>$date);
				 $model->attributes = $ist;
				 $asa->attributes = $aist;
				  if($model->validate()){
					$model->save();
				  }
				  if($asa->validate()){
					$asa->save();
				  }
				 $address = $addr[0]['address'];
				 Yii::app()->db->createCommand()
				 		->delete('imports', 'id=:id', array(':id'=>$addr[0]['id']));
				}else{ $address = "No address is present for you, Right now!";	}
			}else{ $address = $res[0]['address']; }
	 return $address;
	}	
}