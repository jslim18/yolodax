<?php
class RolesEditAction extends CAction{

	private static $controller;
	private static $model;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
	 $rid = @$_GET['rid'];
		self::$model = Roles::model()->findByPk($rid);
		self::$model->setScenario("update");
			if(isset($_POST['Roles'])){
				$this->message="Roles has been updated successfully!";
				$this->saveRoles();
			}
		$data['model'] = self::$model;
	 self::$controller->render('/admin/roles_edit', $data);
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