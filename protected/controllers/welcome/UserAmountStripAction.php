<?php
class UserAmountStripAction extends CAction{


	public function run(){
		if(Yii::app()->user->id!=""){
		 $uid = Yii::app()->user->id;
		}else{
		 $uid = 0;
		}
			$pair = $_POST['pair'];
			$cinfo = Users::model()->currency_type($pair);
			$data['cinfo'] = $cinfo;
			$data['amounts'] = Users::model()->get_user_calc($uid,$cinfo['coin']);
			$data['with'] = Users::model()->withdraw_data($uid);
	 echo Yii::app()->controller->renderPartial('/module/userAmountStrip', $data,true);
	}


}