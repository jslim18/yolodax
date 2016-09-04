<?php
class SettingsAction extends CAction{

	private static $controller;
	private static $model;

	public function run(){
		self::$controller = $this->getController();
		$admin = Yii::app()->user->getId();
	  self::$model = Admins::model()->findByPk($admin);
	  self::$model->setScenario('settings');
	  if(isset($_POST['Admins'])){
		$this->saveAdmin();
	  }
	  self::$model->password = "";
		
	  $data['model'] = self::$model;
	 self::$controller->render("setting",$data);
	}
	
	private function saveAdmin(){
		self::$model->attributes = $_POST['Admins'];
		if(self::$model->validate()){
			if(self::$model->save()){
				Yii::app()->user->setState("name",$_POST['Admins']['username']);
				Yii::app()->user->setState("email",$_POST['Admins']['email']);
				$this->refresh();
			}
		}
	}
	
	private function refresh(){
		Yii::app()->user->setFlash("success",Yii::t("messages","Admin information has been updated successfully!"));
		self::$controller->redirect(Yii::app()->baseUrl."/admin/settings");
	}

}