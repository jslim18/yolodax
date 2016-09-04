<?php
class RequestAction extends CAction{

	private $controller;
	private $model;
	private $message;

	public function run(){
	 $this->controller = $this->getController();
	 $id = $_GET['id'];
	 $data['request'] = Yii::app()->db->createCommand()
	 						->select("c.id,c.fname,c.lname,s.subject,c.email,c.message")
							->from("contact_us c")
							->leftJoin("contact_subjects s","c.subject_id=s.id")
							->where("c.id=:id",array(":id"=>$id))
							->limit(1,0)
							->queryRow();
	 $this->controller->render('/admin/request',$data);
	}

}