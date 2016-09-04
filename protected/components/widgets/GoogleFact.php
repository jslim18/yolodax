<?php

class GoogleFact extends CWidget{

	private $data;
	private $admin;

    public function run(){
		$id = Yii::app()->user->getId();
   		   $this->admin = Admins::model()->findByPk($id);
		   $this->checkG2a();
		   $this->disableG2a();
			if($this->admin->is_g2a == "no" and $this->admin->secret == ""){
			 $InitalizationKey = Yii::app()->g2a->generate_secret_key(16);
			 $this->admin->secret = $InitalizationKey;
			 $this->data['key'] = $InitalizationKey;
			 $this->admin->save();
			 $user  = $this->admin->email;
			 $this->data['img'] = Yii::app()->g2a->getQRCodeGoogleUrl($user,$InitalizationKey);
			}elseif($this->admin->is_g2a == "no" and $this->admin->secret!=""){
			 $InitalizationKey = $this->admin->secret;
			 $this->data['key'] = $InitalizationKey;
			 $user = $this->admin->email;
			 $this->data['img'] = Yii::app()->g2a->getQRCodeGoogleUrl($user,$InitalizationKey);
			}elseif($this->admin->is_g2a == "yes"){
			
			}
     $this->render('g2a',$this->data);
    }

	private function checkG2a(){
		if(isset($_POST['otp_verify'])){
			if($_POST['otp']==""){$this->data['error']="This field cann't be empty!";}
			elseif(! Yii::app()->g2a->verify_key($this->admin->secret, $_POST['otp'])){
				$this->data['error']="Wrong password!";
			}else{
				$this->admin->is_g2a = "yes";
				$this->admin->save();
			}
		}

	}
	
	private function disableG2a(){
		if(isset($_POST['g2a_disable'])){
			$this->admin->secret = "";
			$this->admin->is_g2a = "no";
			$this->admin->save();
		}
	}
}
?>