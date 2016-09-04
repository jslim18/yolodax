<?php
class IndexAction extends CAction{

	private static $model;
	private static $controller;
	private static $fTime;

	public function run(){
		self::$controller = $this->getController();
		self::$model = new AdminLoginForm;
		self::$fTime = 60*60*24;
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'admin-login-form'){
			echo CActiveForm::validate(self::$model);
			Yii::app()->end();
		}

		if(isset($_POST['AdminLoginForm'])){
			self::$model->attributes = $_POST['AdminLoginForm'];
			if(self::$model->validate() && self::$model->login()){			
				//self::$controller->redirect(Yii::app()->user->returnUrl);
			}	
		}
		$data['error'] = "";
		if(isset($_POST['codelogin']) && ! Yii::app()->user->isGuest){
			$code = $_POST['code'];
		   if($code == ""){$data['error'] = "You need to enter code!";}else{
			$db = Admins::model()->findByPk(Yii::app()->user->getId());
			 if(Yii::app()->g2a->verify_key(Yii::app()->user->getState("secret"), $code) && (time()-$db->tt_time) <= self::$fTime ){
				Yii::app()->user->setState("roles",$db->role);
			 }elseif( (time()-$db->tt_time) <= self::$fTime ){
				 $data['error'] = "You entered a wrong code!";
			 }else{
				$this->timeFinish();
			 }

		   }
		}

		$data['model'] = self::$model;
	 $this->render($data);
	}

	private function render($data){
		if(Yii::app()->user->isGuest)
			self::$controller->render("index",$data);
		elseif(Yii::app()->user->getState("roles")==false){
			if( (time()-Yii::app()->user->getState('tt_time')) < self::$fTime){
				self::$controller->layout = "ram";
				self::$controller->render("step2",$data);
			}else{
				$this->timeFinish();
			}

		}else{
			self::$controller->render("index1");
		}
	}
	
	private function timeFinish(){
		Yii::app()->user->logout();
		Yii::app()->session->open();
		Yii::app()->user->setFlash("error",Yii::t("messages","Your time was finished!"));
		self::$controller->redirect(Yii::app()->baseUrl."/admin");
	}

}
