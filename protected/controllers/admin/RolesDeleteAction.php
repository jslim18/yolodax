<?php
class RolesDeleteAction extends CAction{

	public function run(){
		$rid = $_GET['rid'];
		Yii::app()->db->createCommand()
				->delete("roles","id=:rid",array(":rid"=>$rid));
		echo $rid;
		Yii::app()->end();
	}
}