<?php

class ImportDeleteAction extends CAction{

	public $controller;


	public function run(){
	 if($_SERVER['REQUEST_METHOD']=="POST" and Yii::app()->request->isAjaxRequest){
	  $id = $_POST['q'];
	  //Yii::app()->db->createCommand()->delete('import', 'id=:id', array(':id'=>$id));
	  echo $id;die;
	 }else{
	  echo 'No direct script access!';
	 }

	
	}


}