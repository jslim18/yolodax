<?php
class CommissionDeleteAction extends CAction{

	public function run(){
		$pid = $_GET['cpid'];
		Yii::app()->db->createCommand()
				->delete("commission","id=:pid",array(":pid"=>$pid));
		echo $pid;
		Yii::app()->end();
	}
}