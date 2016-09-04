<?php
class ForgotForm extends CFormModel
{
	 public $email;
	 public $user;
	public function rules()
	{
		return array(
			array('email', 'required',"message"=>Yii::t("validate","Email is required!")),
			array("email","email","message"=>Yii::t("validate","Email format is wrong!")),
			array("eamil","exist"),
		);
	}
	
	public function exist(){
	  $this->user = Users::model()->find("email=:email",array(":email"=>$this->email));	
	  if($this->user == null){
		  $this->addError('email', Yii::t("validate","Any user with this email doesn't exist!"));
	  }
	}

	public function forgot_email(){
	$data['user'] = $this->user->username;
	$data['link'] =	$this->forgot_link($this->user->email,$this->user->id);
	$sub = 'Forgot Password Recovery';
	$temp = '/welcome/password_reset';
	$this->user->sendMail('pkumar.sgit143@gmail.com',$this->user->email,$sub,$temp,$data);
	}

	private function forgot_link($email,$uid){
	$t = time();
	$code = md5("/" . $email . "/" . $uid . "/".$t."/");
	$bc = CPasswordHelper::hashPassword($code)."~~~".$code."~~~".$t;
	$upd = array("password_reset_code"=>$bc,"password_reset"=>1);
	Yii::app()->db->createCommand()
			->update("users",$upd,'id=:id',array(":id"=>$uid));
	$link = Yii::app()->getBaseUrl(true)."/welcome/password_reset?u=".$email."&c=".$code;
	 return $link;
	}

}