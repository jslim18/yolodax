<?php

class Amounts extends CActiveRecord
{

	public function tableName(){
		return 'amounts';
	}

	public function rules(){
		return array(
			array("user_id",'required'),
			array('user_id', 'adminAmount',"on"=>"adUpdate"),
			array('user_id', 'numerical', 'integerOnly'=>true),
		);
	}

	public function adminAmount(){

	$uid = $_POST['Amounts']['user_id'];
	$error = array();
	$lock = Users::model()->locked_data($uid);
	$with = Users::model()->withdraw_data($uid);
	 foreach($_POST['Amounts'] as $k=>$v){
	  $sum = @$lock[$k] + @$with[$k];
	 	if($v==null or $v==""){
			$this->addError($k, Yii::t("validate","$k can not be blank!"));
			$error[] = $k;
		}elseif($v < $sum){
			$this->addError($k, Yii::t("validate","$k can not be less than $sum"));
			$error[] = $k;
		}elseif($v < 0){
			$this->addError($k, Yii::t("validate","$k can not be negative!"));
			$error[] = $k;
		}
	 }

	 if( count($error) > 0 ){
	  return false;
	 }else{
	  return true;
	 }

	}

	public function relations(){
		return array(
		);
	}

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

}