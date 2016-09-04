<?php
class EditProfileAction extends CAction{

	public static $model;
	public static $controller;

	public function run(){
		$uid = Yii::app()->user->id;
		self::$controller = $this->getController();
		 $data['uri'] = 'user/edit_profile';
		 self::$model = Users::model()->findByPk($uid);
		 self::$model->password = '';
		 self::$model->setScenario('update');
		 self::ajax_validation();

		if(isset($_POST['Users'])){
			self::$model->attributes = $_POST['Users'];
			if(self::$model->validate()){
				self::$model->save();
				$this->refresh();
			}
		}
		$ct = Country::model()->findAll();
		$country = array(""=>"Select Country");
		foreach($ct as $k){$country[$k->name]=$k->name;}
		$data['country'] = $country;
		 $data['model'] = self::$model;
	 self::$controller->render('edit_profile',$data);
	}
	
	private static function ajax_validation(){
		if(isset($_POST['ajax']) && $_POST['ajax']==='edit-profile-form'){
			echo CActiveForm::validate(self::$model);
			Yii::app()->end();
		}		
	}
	
	private function refresh(){
		Yii::app()->user->setFlash("success","Information has been updated successfully!");
		self::$controller->redirect(Yii::app()->baseUrl."/user/edit_profile");
	}
}