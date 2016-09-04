<?php

class GoogleFactUser extends CWidget{

	private $data;
	private $admin;

    public function run(){
		$id = Yii::app()->user->getId();
   		   $this->admin = Users::model()->findByPk($id);

		   $this->checkG2a();
		   $this->disableG2a();
			if($this->admin->is_g2a == "no" and $this->admin->secret == ""){
			 $InitalizationKey = Yii::app()->g2a->generate_secret_key(16);
			 $this->admin->secret = $InitalizationKey;
			$udp['secret'] = $InitalizationKey;
			Yii::app()->db->createCommand()
					->update("users",$udp,"id=:id",array(":id"=>$id));
					
			 $user  = $this->admin->email;
			 $this->data['img'] = Yii::app()->g2a->getQRCodeGoogleUrl($user,$InitalizationKey);
			 $this->data['key'] = $InitalizationKey;
			}elseif($this->admin->is_g2a == "no" and $this->admin->secret!=""){
			 $InitalizationKey = $this->admin->secret;
			 $user = $this->admin->email;
			 $this->data['img'] = Yii::app()->g2a->getQRCodeGoogleUrl($user,$InitalizationKey);
			 $this->data['key'] = $InitalizationKey;
			}elseif($this->admin->is_g2a == "yes"){
			
			}
     $this->render('g2auser',$this->data);
    }

	private function checkG2a(){
		if(isset($_POST['otp_verify'])){
			if($_POST['otp']==""){$this->data['error']="This field cann't be empty!";}
			elseif(! Yii::app()->g2a->verify_key($this->admin->secret, $_POST['otp'])){
				$this->data['error']="Wrong password!";
			}else{
				$id = $this->admin->id;
				Yii::app()->user->setState("secret",$this->admin->secret);
				$this->admin->is_g2a = "yes";
				Yii::app()->user->setState("is_g2a","yes");
		$udp['is_g2a']='yes';
		Yii::app()->db->createCommand()
				->update("users",$udp,"id=:id",array(":id"=>$id));
			}
		}

	}

	private function disableG2a(){
		if( isset($_POST['g2a_disable']) ){
			$this->admin->secret = "";
			Yii::app()->user->setState("secret","");
			$this->admin->is_g2a = "no";
			Yii::app()->user->setState("is_g2a","no");
			$id= $this->admin->id;

			$udp['is_g2a']='no';
			$udp['secret'] = '';
			Yii::app()->db->createCommand()
					->update("users",$udp,"id=:id",array(":id"=>$id));
		}
	}
}
?>