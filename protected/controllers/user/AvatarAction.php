<?php
class AvatarAction extends CAction{
	private $image;
	private $file;
	public static $model;
	public static $controller;

	public function run(){
		$uid = Yii::app()->user->id;
		$data['uri'] = 'user/avatar';
		self::$controller = $this->getController();
		self::$model = Users::model()->findByPk($uid);
		self::$model->avatar = '';
		self::$model->setScenario('fileUpload');
		self::ajax_validation();

		if(isset($_POST['Users'])){
			self::$model->attributes = $_POST['Users'];
			if(self::$model->validate()){
				$this->image = CUploadedFile::getInstance(self::$model,'avatar');
				$this->file = date("Y-m-d_H-i-s")."_".$this->image;
				self::$model->avatar = $this->file;
				$this->upload();
				self::$model->update(array('avatar'));
				$this->refresh();
			}
		}


		$data['model'] = self::$model;
	 self::$controller->render('avatar',$data);
	}

	private static function ajax_validation(){
		if(isset($_POST['ajax']) && $_POST['ajax']==='change-avatar-form'){
			echo CActiveForm::validate(self::$model);
			Yii::app()->end();
		}
	}

	private function upload(){
		$this->image->saveAs("./upload/user/".$this->file);
		$this->create_thumb();
	}

	private function create_thumb(){
		$image = Yii::app()->image->load("./upload/user/".$this->file);
		$image->resize(200, 200);
		$image->save("./upload/thumb/".$this->file);
	}

	private function refresh(){
		Yii::app()->user->setFlash("success","Profile image has been updated successfully!");
		self::$controller->redirect(Yii::app()->baseUrl."/user/avatar");
	}

}