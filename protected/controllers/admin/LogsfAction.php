<?php
class LogsfAction extends CAction{

	private static $controller;
	public function run(){
		self::$controller->redirect(Yii::app()->request->baseUrl."/admin");	 
	}
}