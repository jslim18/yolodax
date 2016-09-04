<?php
class AdminsDeleteAction extends CAction{

	public function run(){
		$aid = $_GET['aid'];
		Yii::app()->db->createCommand()
				delete("admins","id=:aid",array(":aid"=>$aid));
		echo $aid;
		Yii::app()->end();
	}

}
