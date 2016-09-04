<?php

class ChangePasswordForm extends CFormModel
{

	public $password;
	public $new_password1;
	public $new_password2;

	public function rules()
	{
		return array(
			array('password, new_password1,new_password2', 'required',"message"=>Yii::t("validate","{attribute} is required!")),
			array('new_password1','length', 'min'=>6,'max'=>12,"message"=>Yii::t("validate","Password can contain 6-12 characters!")),
			array('new_password2', 'compare', 'compareAttribute'=>'new_password1',"message"=>Yii::t("validate","Passwords are not matching!")),
			array('password','check_old_password'),
		);
	}

	public function check_old_password(){
		$p = $this->password;
		$uid = Yii::app()->user->id;
		$res = Yii::app()->db->createCommand()
					->select("password")
					->from("users")
					->where("id=:uid",array(":uid"=>$uid))
					->queryRow();
		if(! CPasswordHelper::verifyPassword($this->password,$res['password'])){
			$this->addError('password', Yii::t("validate","Wrong password!"));
		}
	}
}