<?php
class RolesAction extends CAction{
	private static $controller;

	public function run(){
	 self::$controller = $this->getController();

	 $crt = new CDbCriteria;
	 $crt->select = "*";
	 $crt->order = "id desc";
	 $data['roles'] = Roles::model()->findAll($crt);
	 self::$controller->render('/admin/roles',$data);
	}

}