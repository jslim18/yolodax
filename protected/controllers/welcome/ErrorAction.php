<?php
class ErrorAction extends CAction{
	

	public function run(){
		$error=Yii::app()->errorHandler->error;
		if($error['code']==403){
		 $this->getController()->render("403");
		}
		if($error['code']==404){
		 $this->getController()->render("404");
		}
	}
	
	
}
