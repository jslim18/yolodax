<?php
class AdminsEditAction extends CAction{

	private static $controller;
	private static $model;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
	 $aid = @$_GET['aid'];
		self::$model = Admins::model()->findByPk($aid);
		self::$model->setScenario("adminss");
			if(isset($_POST['Admins'])){
				$this->message="Admins has been updated successfully!";
				$this->saveAdmins();
			}
		self::$model->password = "";
	 $data['roles'] = $this->allRoles();
		$data['model'] = self::$model;
	 self::$controller->render('admins_edit', $data);
	}

	private function allRoles(){
	 $allRoles = Roles::model()->findAll();
	 $roles = array(""=>"-Select-");
	 if(count($allRoles)>0 ){foreach($allRoles as $k){$roles[$k['id']]=$k['role_name'];}}
	 return $roles;
	}

	private function saveAdmins(){
		self::$model->confirm_password = @$_POST['Admins']['confirm_password'];
		self::$model->attributes = $_POST['Admins'];
		if(self::$model->validate()){
			if(self::$model->save()){$this->refresh();}
		}
	}

	private function refresh(){
		Yii::app()->user->setFlash("success",Yii::t("messages",$this->message));
		self::$controller->redirect(Yii::app()->baseUrl."/admin/admins");
	}
}