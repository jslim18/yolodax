<?php
class ContactSubjectAction extends CAction{
	private static $controller;
	private $model;
	public function run(){
		self::$controller = $this->getController();
	 $this->model = new ContactSubjects;
	 $this->saveMe();
	 $data['subs'] = Yii::app()->db->createCommand()
	 					->select("*")
						->from("contact_subjects")
						->order("id desc")
						->queryAll();
	 $data['model'] = $this->model;
	 self::$controller->render("/admin/contact_subject",$data);
	}
	
	private function saveMe(){
		if(isset($_POST['ContactSubjects'])){
			$this->model->attributes = $_POST['ContactSubjects'];
			if($this->model->validate()){
				if($this->model->save()){$this->refresh();}
			}
		}
	}

	private function refresh(){
		Yii::app()->user->setFlash("success",Yii::t("messages","Contact-us subject has been added successfully!"));
		self::$controller->redirect(Yii::app()->baseUrl."/admin/contact_subject");
	}

}