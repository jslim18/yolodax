<?php
class AdminsAddAction extends CAction{

	private static $controller;
	private static $model;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
	 self::$model = new Admins;
	 $data['model'] = self::$model;
	 self::$model->setScenario('admins');
		if(isset($_POST['Admins'])){
			$this->message="New Admin has been added successfully!";
			$this->saveAdmins();
		}
	 $data['roles'] = $this->allRoles();
	 $crt = new CDbCriteria;
	 $crt->select = "*";
	 $crt->condition = 'id<>1';
	 $crt->order = "id desc";
	 self::$controller->render('/admin/admins_add',$data);
	}

	private function allRoles(){
	 $allRoles = Roles::model()->findAll();
	 $roles = array(""=>"-Select-");
	 if(count($allRoles)>0 ){foreach($allRoles as $k){$roles[$k['id']]=$k['role_name'];}}
	 return $roles;
	}

	private function saveAdmins(){
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