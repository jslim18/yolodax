<?php
class FundsAction extends CAction{

	public function run(){
		 $uid = Yii::app()->user->id;
			$data['amounts'] = Amounts::model()->find("user_id=:uid",array(":uid"=>$uid));
			$data['locked'] = Users::model()->locked_data($uid);
			$data['withdraw'] = Users::model()->withdraw_data($uid);

			$data['currn'] = Ccurrencies::model()->findAll();
		 $this->getController()->render('funds',$data);
	}	
}