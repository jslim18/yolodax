<?php
class ForgotAction extends CAction{

	public function run(){
		$model = new ForgotForm;

		if(isset($_POST['ajax']) && $_POST['ajax'] === 'forgot-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['ForgotForm'])){
			$model->attributes = $_POST['ForgotForm'];
			if($model->validate()){
			 $model->forgot_email();
			 $this->refresh();
			}
				
		}
		$data['model'] = $model;
		 $this->getController()->render('forgot',$data);		
	}
	
	private function refresh(){
	 Yii::app()->user->setFlash("success","Password change email has been sent!");
	 $this->getController()->refresh();
	}

}