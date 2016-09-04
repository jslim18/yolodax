<?php
class DeleteNewsAction extends CAction{
	private static $controller;

	public function run(){
		$id = $_POST['d'];
	 Yii::app()->db->createCommand()
	 			->delete("news","id=:id",array(":id"=>$id));
	 echo $id;
	 Yii::app()->end();
	}
}