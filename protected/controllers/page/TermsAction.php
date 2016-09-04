<?php
error_reporting(E_ALL);
class TermsAction extends CAction{

	public function run(){
		$controller = $this->getController();
		$data['terms'] = Yii::app()->db->createCommand()
							->select("content")
							->from("contents")
							->where("title='terms_privacy_conditions'")
							->queryRow();
	    $controller->render("terms",$data);
	}
}