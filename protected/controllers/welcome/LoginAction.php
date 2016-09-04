<?php
class LoginAction extends CAction{


	public function run(){
		$model = new LoginForm;

		if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['LoginForm'])){
		$model->attributes = $_POST['LoginForm'];
		if($model->validate() && $model->login()){
		$isg = Yii::app()->user->getState("is_g2a");
			if( $isg == "yes" ){
			 Yii::app()->controller->render("step2");
			 die;
			}else{
			 Yii::app()->controller->redirect(Yii::app()->user->returnUrl);
			}
		}}
		
		if(isset($_POST['otp_auth'])){
		 $u = Yii::app()->user;
		 $s = $u->getState("secret");
		 $p = $_POST['otp'];
		 $data = array();
		  if($p != ""){
		  	if(Yii::app()->g2a->verify_key($s, $p)){
			 Yii::app()->user->id = Yii::app()->user->getState("idd");
			 Yii::app()->user->name = Yii::app()->user->getState("usernamee");
			Yii::app()->controller->redirect(Yii::app()->user->returnUrl);
			}else{ $data["error"] = "Password is wrong!";}
		  }else{ $data["error"] = "This field can't be empty!";}
		  Yii::app()->controller->render("step2",$data);die;
		}

		$data['model'] = $model;
	 Yii::app()->controller->render('login',$data);
	}

}