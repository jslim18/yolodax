<?php
class UserIdentity extends CUserIdentity{

	private $_id;
	const ERROR_NOT_VERIFY=12;
	const ERROR_NOT_ACTIVE=13;

	public function authenticate(){
		$user=Users::model()->find('LOWER(username)=?',array(strtolower($this->username)));
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		elseif($user->verify == 0){
			$this->errorCode=self::ERROR_NOT_VERIFY;
		}elseif($user->status == 0){
			$this->errorCode=self::ERROR_NOT_ACTIVE;
		}else{
			$this->setState("email",$user->email);
			$this->setState("roles","user");
			$this->setState("secret",$user->secret);
			$this->setState("is_g2a",$user->is_g2a);
			$this->setState("__returnUrl",Yii::app()->baseUrl."/user/profile");
			if($user->is_g2a == "yes"){
			Yii::app()->user->setFlash("g2a","on");
			$this->setState("idd",$user->id);
			$this->setState("usernamee",$user->username);
			}else{
			$this->_id=$user->id;
			$this->username=$user->username;
			}

			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode==self::ERROR_NONE;
	}

	public function aauthenticate(){
		$user=Admins::model()->find('LOWER(username)=?',array(strtolower($this->username)));
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->_id=$user->id;
			$this->username=$user->username;
			$this->setState("email",$user->email);
			if($user->is_g2a == "yes"){
				$t = time();
				$this->setState("secret",$user->secret);
				$this->setState("tt_time",$t);
				$user->tt_time = $t;
				$user->save();
			}else{
				$this->setState("roles",$user->role);
			}
			$this->setState("__returnUrl",Yii::app()->baseUrl."/admin");
			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode==self::ERROR_NONE;
	}

	public function getId(){
		return $this->_id;
	}
}