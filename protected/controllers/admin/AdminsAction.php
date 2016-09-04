<?php
class AdminsAction extends CAction{
	private static $controller;

	public function run(){
	 self::$controller = $this->getController();

	 $data['admins'] = Yii::app()->db->createCommand()
	 					->select("a.id,a.username,a.email,r.role_name")
						->from("admins a")
						->join("roles r","r.id=a.role")
						->order("a.id desc")
						->queryAll();
	 self::$controller->render('/admin/admins',$data);
	}

}