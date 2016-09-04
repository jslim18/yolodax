<?php
class ChangePasswordAction extends CAction{

	public static $model;
	public static $controller;

	public function run(){
		 $uid = Yii::app()->user->id;
		$data['uri'] = 'user/change_password';
		self::$controller = $this->getController();
		self::$model = Users::model()->findByPk($uid);
		self::$model->setScenario('updatePass');
		self::$model->password = "";
		self::ajax_validation();

		if(isset($_POST['Users'])){
			self::$model->attributes = $_POST['Users'];
			if(self::$model->validate()){
				self::$model->save();
			 $this->refresh();
			}
		}
		$data['user'] = Yii::app()->db->createCommand()
							->select("avatar")
							->from("users")
							->where("id=:uid",array(":uid"=>$uid))
							->queryRow();
		$data['model'] = self::$model;
	 self::$controller->render('change_password',$data);
	}

	private static function ajax_validation(){
		if(isset($_POST['ajax']) && $_POST['ajax']==='change-password-form'){
			echo CActiveForm::validate(self::$model);
			Yii::app()->end();
		}
	}

	private function refresh(){
		Yii::app()->user->setFlash("success","Password has been updated successfully!");
		self::$controller->redirect(Yii::app()->baseUrl."/user/change_password");
	}
}