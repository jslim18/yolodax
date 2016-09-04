<?php
class TakeBackUpAction extends CAction{

	public function run(){
	 Yii::app()->backs->backup_tables();
	}
	
}