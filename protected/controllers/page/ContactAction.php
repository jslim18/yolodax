<?php
class ContactAction extends CAction{
	private $model;
	private $controller;
	private $message;
	public function run(){
		$this->controller = $this->getController();
	 $this->model = new ContactUs;
	 $this->saveMe();
	 $subs = ContactSubjects::model()->findAll();
	 $temp = array(""=>"- Select Subject -");
	 if(!empty($subs)){foreach($subs as $k){$temp[$k->id]=$k->subject;}}
	 $data['subs'] = $temp;
	 $data['model'] = $this->model;
	 $this->controller->render("contact",$data);
	}
	
	private function saveMe(){
		if(isset($_POST['ContactUs'])){
		 $this->model->attributes = $_POST['ContactUs'];
			if($this->model->validate()){if($this->model->save()){
			$this->message = "Your request has been sent successfully!";
			$this->refresh();}}
		}
	}

	private function refresh(){
		Yii::app()->user->setFlash("success",Yii::t("messages",$this->message));
	 $this->controller->redirect(Yii::app()->baseUrl."/page/contact");
	}


}