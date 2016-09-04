<?php
class SignupAction extends CAction{
	
	private $file;
	private $image;
	public static $controller;
	public static $model;
	
	public function run(){
		self::$model = new Users;
		self::$controller = $this->getController();
		self::ajax_validation();
		
		if(isset($_POST['Users'])){$this->signup();	}
		$data['model'] = self::$model;
		$ct = Country::model()->findAll();
		$country = array(""=>"Select Country");
		foreach($ct as $k){$country[$k->name]=$k->name;}
		$data['country'] = $country;
		$this->render($data);
	}
	
	private function signup(){
		self::$model->attributes = $_POST['Users'];
		if(self::$model->validate()){
			if(self::$model->save()){$this->refresh();}
		}
	}
	
	private static function ajax_validation(){
		if(isset($_POST['ajax']) && $_POST['ajax']==='signup-form'){
			echo CActiveForm::validate(self::$model);
			Yii::app()->end();
		}
	}
	
	private function refresh(){
		Yii::app()->user->setFlash("success",Yii::t("messages","You have been registered successfully!"));
		self::$controller->redirect(Yii::app()->baseUrl."/login");
	}
	
	private function render($data){
		self::$controller->render("signup",$data);	
	}

}
