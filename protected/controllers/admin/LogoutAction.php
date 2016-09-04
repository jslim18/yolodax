<?php
class LogoutAction extends CAction{

	private static $controller;
	public function run(){
		self::$controller = $this->getController();
		Yii::app()->user->logout();
		Yii::app()->session->open();
		Yii::app()->user->setFlash("success",Yii::t("messages","You have been logged-out successfully!"));
		self::$controller->redirect(Yii::app()->request->baseUrl."/admin");	 
	}
}