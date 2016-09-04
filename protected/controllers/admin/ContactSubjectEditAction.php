<?php
class ContactSubjectEditAction extends CAction{

	private static $controller;
	private static $model;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
	 $aid = @$_GET['aid'];
		self::$model = ContactSubjects::model()->findByPk($aid);
		self::$model->setScenario("update");
			if(isset($_POST['ContactSubjects'])){
				$this->saveMe();
			}

		$data['model'] = self::$model;
	 self::$controller->render('/admin/contact_subject_edit', $data);
	}

	private function saveMe(){
		self::$model->attributes = $_POST['ContactSubjects'];
		if(self::$model->validate()){
			if(self::$model->save()){
				$this->message="Contact-us subject has been updated successfully!";
				$this->refresh();
			}
		}
	}

	private function refresh(){
		Yii::app()->user->setFlash("success",Yii::t("messages",$this->message));
		self::$controller->redirect(Yii::app()->baseUrl."/admin/contact_subject");
	}

}