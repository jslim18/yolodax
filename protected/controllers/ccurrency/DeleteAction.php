<?php
class DeleteAction extends CAction{

	private static $model;
	private static $controller;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
		$this->_ccurrencyDelete();
	}

	private function _ccurrencyDelete(){
		echo $_GET['cid'];
		Yii::app()->end();
	}
}