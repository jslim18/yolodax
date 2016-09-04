<?php
class RequestDeleteAction extends CAction{

	private $controller;

	public function run(){
		$id = $_POST['d'];
		Yii::app()->db->createCommand()
				->delete("contact_us","id=:id",array("id"=>$id));
		echo $id;
		Yii::app()->end();
	}

}