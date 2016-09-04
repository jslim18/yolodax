<?php
class IndexAction extends CAction{

	public function run(){
		 Yii::app()->controller->render('index');
	}
	
}
