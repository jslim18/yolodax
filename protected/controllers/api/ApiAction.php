<?php
class ApiAction extends CAction{

	private static $model;
	private static $controller;
	private $msg;

	public function run(){
		self::$controller = $this->getController();
		$uid = Yii::app()->user->id;
		self::$model = new UserApi;
		$data['model'] = self::$model;
		self::ajax_validation();
		if(isset($_POST['UserApi'])){$this->create_app();}
		if(isset($_POST['update'])){$this->update_app();}
		if(isset($_POST['disable'])){$this->disable_app();}

		$data['api'] = Yii::app()->db->createCommand()
						->select("*")
						->from("user_api")
						->where("user_id=:uid",array(":uid"=>$uid))
						->order("id desc")
						->queryAll();
	    self::$controller->render("api",$data);
	}

	private function update_app(){
	 UserApi::model()->update_app();
	 $this->msg = Yii::t("messages","API has been modified successfully!");
	 $this->refresh();
	}

	private function disable_app(){
	 UserApi::model()->disable_app();
	 if($_POST['disable']==Yii::t('content',"Disable")){ $this->msg = Yii::t("messages","API has been disabled successfully!");}
	 if($_POST['disable']==Yii::t('content',"Activate")){$this->msg = Yii::t("messages","API has been activated successfully!");}
	 $this->refresh();
	}

	private function create_app(){
	 self::$model->attributes = $_POST['UserApi'];
		if(self::$model->validate()){
			self::$model->save();
		 $this->msg = Yii::t("messages","Your application has been registered successfully!");
		 $this->refresh();
		}
	}

	private static function ajax_validation(){
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'create-api-key-form'){
			echo CActiveForm::validate(self::$model);
			Yii::app()->end();
		}
	}

	private function refresh(){
		Yii::app()->user->setFlash("success",$this->msg);
		self::$controller->redirect(Yii::app()->baseUrl."/user/api");
	}
}