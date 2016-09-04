<?php
class RolesAddAction extends CAction{

	private static $controller;
	private static $model;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
	 self::$model = new Roles;
	 $data['model'] = self::$model;
	 self::$model->setScenario('insert');
		if(isset($_POST['Roles'])){
			$this->message="New Role has been added successfully!";
			$this->saveRoles();
		}
	 self::$controller->render('/admin/roles_add',$data);
	}

	private function saveRoles(){
		self::$model->attributes = $_POST['Roles'];
		if(self::$model->validate()){
			if(self::$model->save()){$this->refresh();}
		}
	}

	private function refresh(){
		Yii::app()->user->setFlash("success",Yii::t("messages",$this->message));
		self::$controller->redirect(Yii::app()->baseUrl."/admin/roles");
	}

}