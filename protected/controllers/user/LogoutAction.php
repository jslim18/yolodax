<?php

class LogoutAction extends CAction{
	
	public function run(){
		Yii::app()->user->logout();
		Yii::app()->session->open();
		Yii::app()->user->setFlash("success",Yii::t("messages","You have been logged-out successfully!"));
		Yii::app()->controller->redirect(Yii::app()->request->baseUrl."/login");
	}
	
}