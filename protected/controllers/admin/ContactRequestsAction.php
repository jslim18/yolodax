<?php
class ContactRequestsAction extends CAction{

	private $controller;
	private $model;
	private $message;

	public function run(){
	 $this->controller = $this->getController();
	 $data['requests'] = Yii::app()->db->createCommand()
	 			->select("c.`id`, concat(c.`fname`,' ',c.`lname`) as name, s.`subject`, c.`email`, c.`message`,c.`created_at`")
				->from("contact_us c")
				->leftJoin("contact_subjects s","c.subject_id=s.id")
				->order("c.id desc")
				->queryAll();
	 $this->controller->render('/admin/contact_requests',$data);
	}

}