<?php
class PairDeleteAction extends CAction{

	private static $controller;
	private static $model;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
	$this->_ccurrencyPairDelete();
	}

	private function _ccurrencyPairDelete(){
		$pid = $_GET['cpid'];
		Yii::app()->db->createCommand()
					->delete("ccurrency_pair","pid=:pid",array(":pid"=>$pid));
		echo $pid;
		Yii::app()->end();
	}

}