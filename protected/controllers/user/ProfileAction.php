<?php
class ProfileAction extends CAction{

	public function run(){
		 $id = Yii::app()->user->id;
		 $data['user'] = Users::model()->findByPk($id);
		 Yii::app()->controller->render('profile',$data);
	}	
}